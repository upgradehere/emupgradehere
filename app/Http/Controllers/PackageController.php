<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageM;
use App\Models\LookupC;
use App\Models\LaboratoryExaminationGroupM;
use App\Models\LaboratoryExaminationTypeM;
use App\Models\LaboratoryExaminationM;
use Validator;
use Session;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        $treatment = LookupC::where("lookup_type", "examination_type")
                                ->get();

        $laboratorium = LaboratoryExaminationGroupM::with([
                        "examinationTypes",
                        "examinationTypes.examinations"
                    ])->get();

        $data['treatment'] = $treatment;
        $data['laboratorium'] = $laboratorium;

        return view('package/package', $data);
    }

    public function getDataPackage(Request $request)
    {
        try {
            $query = PackageM::query();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('package_name', 'ilike', '%' . $searchValue . '%');
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

            // Total records before filtering
            $totalRecords = PackageM::count();
        
            // Total records after filtering
            $filteredRecords = $query->count();

            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $data = $query->offset($start)->limit($length)->get();

            // Map additional fields
            $data = $data->map(function ($item) {
                $item->price = 'Rp ' . number_format($item->price, 0, ',', '.');
        
                return $item;
            });

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

    public function store(Request $request)
    {
        $rules = [
            'package_name' => 'required',
            'package_code' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
        ];

        $messages = [
            'package_name.required' => 'Nama Paket wajib diisi',
            'package_code.required' => 'Kode Paket wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'desc.required' => 'Deskripsi Paket wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('package');
        }

        $package = new PackageM;
        $package->package_name = $request->package_name;
        $package->package_code = $request->package_code;
        $package->price = $request->price;
        $package->desc = $request->desc;

        if (isset($request->treatment)) {
            foreach ($request->treatment as $t) {
                $package->$t = 1;
            }
        }

        $lab_id = [];
        if (isset($request->laboratory_item)) {
            foreach ($request->laboratory_item as $l) {
                array_push($lab_id, $l);
            }
        }

        $lab_id = json_encode($lab_id);

        $package->lab = $lab_id;

        $package->save();

        session()->flash('success', 'Paket baru telah disimpan');
        return redirect()->route('package');
    }

    public function delete($id)
    {
        $package = PackageM::find($id);

        if ($package->delete()) {
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

    public function detail($id)
    {
        $data = [];
        $package = PackageM::find($id);
        
        if ($package) {
            $data['package'] = $package;
            
            $treatment = LookupC::where("lookup_type", "examination_type")
                                ->get();

            $laboratorium = LaboratoryExaminationGroupM::with([
                "examinationTypes",
                "examinationTypes.examinations"
            ])->get();

            $data['treatment'] = $treatment;
            $data['laboratorium'] = $laboratorium;

            $lab_ids = json_decode($package->lab);
            $lab_item_current = LaboratoryExaminationM::with('type.group')->whereIn('laboratory_examination_id', $lab_ids)->get();

            $data['laboratorium_current'] = $lab_item_current;

            return view('package/detail', $data);
        } else {
            return view('errors/404');
        }
    }

    public function duplicate($id)
    {
        $package = PackageM::find($id);

        $new = new PackageM;
        foreach ($package->getAttributes() as $idx => $val) {
            if ($idx == 'id' || $idx == 'created_at' || $idx == 'deleted_at') {
                continue;
            }

            if ($idx == 'package_name' || $idx == 'package_code') {
                $new->$idx = $val.'-DUPLIKASI-'.date('dFY');
            } else {
                $new->$idx = $val;
            }
        }

        if ($new->save()) {
            $data = [
                'status' => 'success',
                'message' => 'Duplicate success',
            ];
            
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Duplicate failed',
                'data' => 'Kesalahan terjadi, paket gagal diduplikasi, harap hubungi Admin kami',
            ];

            return response()->json($data, 200);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'package_name' => 'required',
            'package_code' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
        ];

        $messages = [
            'package_name.required' => 'Nama Paket wajib diisi',
            'package_code.required' => 'Kode Paket wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'desc.required' => 'Deskripsi Paket wajib diisi',
        ];

        $id = $request->id;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('package.detail', ['id' => $id]);
        }

        $package = PackageM::find($id);
        $package->package_name = $request->package_name;
        $package->price = $request->price;
        $package->desc = $request->desc;

        $package->anamnesis = 0;
        $package->rontgen = 0;
        $package->audiometry = 0;
        $package->spirometry = 0;
        $package->ekg = 0;
        $package->usg = 0;
        $package->treadmill = 0;
        $package->papsmear = 0;
        $package->resume = 0;
        $package->refraction = 0;
        $package->lab = "[]";

        if (isset($request->treatment)) {
            foreach ($request->treatment as $t) {
                $package->$t = 1;
            }
        }

        $lab_id = [];
        if (isset($request->laboratory_item)) {
            foreach ($request->laboratory_item as $l) {
                array_push($lab_id, $l);
            }
        }

        $lab_id = json_encode($lab_id);

        $package->lab = $lab_id;

        $package->save();

        session()->flash('success', 'Paket diperbarui');
        return redirect()->route('package.detail', ['id' => $id]);
    }
}
