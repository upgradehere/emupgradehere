<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartementM;
use App\Models\CompanyM;
use Validator;

class DepartementController extends Controller
{

    public function index (Request $request)
    {
        $data = [];

        $company = CompanyM::all();
        
        $data['company'] = $company;

        $data['company_id'] = 'A';

        if ($request->get('company-id')) {
            if (is_numeric($request->get('company-id'))) {
                $data['company_id'] = $request->get('company-id');
            }
        }
        
        return view('departement.index', $data);
    }

    public function data(Request $request, $company_id)
    {
        try {
            // Base query
            $query = DepartementM::with('company'); // Eager load relations

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('departement_name', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('departement_code', 'ilike', '%' . $searchValue . '%');
                });
            }

            if ($request->has('order') && is_array($request->order)) {
                foreach ($request->order as $order) {
                    $columnIndex = $order['column'];
                    $columnName = $request->columns[$columnIndex]['data'];
                    $direction = $order['dir'];
                    $query = $query->orderBy($columnName, $direction);
                }
            }

            if ($company_id !== 'A') {
                $query->where('company_id', $company_id);
            }
           
            // Total records before filtering
            $totalRecords = DepartementM::count();
        
            // Total records after filtering
            $filteredRecords = $query->count();

            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $data = $query->offset($start)->limit($length)->get();

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function show($company_id)
    {
        $departement = DepartementM::where('company_id', $company_id)->get();

        $data = [
            'status' => 'success',
            'message' => 'Success get departement',
            'data' => $departement,
        ];

        return response()->json($data, 200);
    }

    public function detail($id)
    {
        $data = [];
        $departement = DepartementM::with('company')->where('departement_id',$id)->first();
        $company = CompanyM::all();
        
        if ($departement) {
            $data['departement'] = $departement;
            $data['company'] = $company;
            
            return view('departement/detail', $data);
        } else {
            return view('errors/404');
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'company_id' => 'required',
            'departement_name' => 'required',
            'departement_code' => 'required',
        ];

        $messages = [
            'company_id.required' => 'Perusahaan wajib diisi',
            'departement_name.required' => 'Nama Departemen wajib diisi',
            'departement_code.required' => 'Kode Departemen wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('departement', ['company-id' => $request->company_id]);
        }

        $check = DepartementM::where('departement_code', $request->departement_code)->get();
        if ($check->count() > 0) {
            session()->flash('error', 'Kode Departemen yang sama sudah ada');
            return redirect()->route('departement', ['company-id' => $request->company_id]);
        }

        $departement = new DepartementM;
        foreach ($request->all() as $k => $r) {
            if ($k != '_token') {
                $departement->$k = $r;
            }
        }

        if($departement->save()) {
            session()->flash('success', 'Departemen baru berhasil disimpan');
        } else {
            session()->flash('error', 'Kesalahan terjadi, Departemen gagal disimpan, harap hubungi Admin kami');
        }

        return redirect()->route('departement', ['company-id' => $departement->company_id]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'company_id' => 'required',
            'departement_name' => 'required',
            'departement_code' => 'required',
        ];

        $messages = [
            'id.required' => 'Departemen tidak dipilih',
            'company_id.required' => 'Perusahaan wajib diisi',
            'departement_name.required' => 'Nama Departemen wajib diisi',
            'departement_code.required' => 'Kode Departemen wajib diisi',
        ];

        $id = $request->id;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('departement.detail', ['id' => $id]);
        }

        $departement = DepartementM::find($id);

        if ($departement) {
            foreach ($request->all() as $k => $r) {
                if ($k != '_token' && $k != 'id') {
                    $departement->$k = $r;
                }
            }
    
            if($departement->save()) {
                session()->flash('success', 'Departemen baru berhasil diperbarui');
            } else {
                session()->flash('error', 'Kesalahan terjadi, Departemen gagal diperbarui, harap hubungi Admin kami');
            }
        } else {
            session()->flash('error', 'Departemen tidak ditemukan');
        }

        return redirect()->route('departement', ['company-id' => $departement->company_id]);
    }

    public function delete($id)
    {
        $departement = DepartementM::find($id);

        if ($departement->delete()) {
            $data = [
                'status' => 'success',
                'message' => 'Delete success',
            ];
            
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Delete failed',
                'data' => 'Kesalahan terjadi, data gagal dihapus, harap hubungi Admin kami',
            ];

            return response()->json($data, 200);
        }
    }
}
