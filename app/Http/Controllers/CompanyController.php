<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\CompanyM;
use App\Models\User;
use App\Models\McuProgramM;
use App\Models\DepartementM;
use App\Models\EmployeeM;
use App\Models\McuT;
use Validator;
use Session;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        return view('company/index');
    }

    public function getDataCompany(Request $request)
    {
        try {
            // Base query
            $query = CompanyM::with('program', 'mcu'); // Eager load relations
        
            // Apply search filter
            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('company_name', 'ilike', '%' . $searchValue . '%');
                });
            }
        
            // Apply sorting
            if ($request->has('order') && is_array($request->order)) {
                foreach ($request->order as $order) {
                    $columnIndex = $order['column'];
                    $columnName = $request->columns[$columnIndex]['data'];
                    $direction = $order['dir'];
                    $query = $query->orderBy($columnName, $direction);
                }
            }
        
            // Total records before filtering
            $totalRecords = CompanyM::count();
        
            // Total records after filtering
            $filteredRecords = $query->count();
        
            // Apply pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
        
            $data = $query->offset($start)->limit($length)->get();
        
            // Map additional fields
            $data = $data->map(function ($item) {
                $item->total_program = count($item->program);
                $item->total_mcu = count($item->mcu);
        
                return $item;
            });
        
            // Return response
            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'company_name' => 'required',
            'company_code' => 'required',
            'npwp_company_number' => 'required',
            'pic_name' => 'required',
            'pic_email' => 'required|email',
            'pic_phone_number' => 'required|numeric',
            'company_address' => 'required',
            'password' => 'required|min:8',
            'letterhead' => [
                'required',
                'file',
                'mimes:jpg,png',
                'max:200'
            ],
        ];

        $messages = [
            'company_name.required' => 'Nama Perusahaan wajib diisi',
            'company_code.required' => 'Kode Perusahaan wajib diisi',
            'npwp_company_number.required' => 'NPWP Perusahaan wajib diisi',
            'pic_name.required' => 'Nama PIC wajib diisi',
            'pic_email.required' => 'Email PIC wajib diisi',
            'pic_email.email' => 'Email PIC tidak valid',
            'pic_phone_number.required' => 'No Telp PIC wajib diisi',
            'pic_phone_number.numeric' => 'No Telp PIC harus berupa angka',
            'company_address.required' => 'Alamat Perusahaan wajib diisi',
            'password.required' => 'Password PIC wajib diisi',
            'password.min' => 'Password PIC minimal 8 karakter',
            'letterhead.required' => 'File Kop wajib diisi',
            'letterhead.mimes' => 'File Kop hanya diperbolehkan tipe .jpg atau .png',
            'letterhead.max' => 'File Kop melebihi batas maksimal 100kb',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('company');
        }

        $company = new companyM;

        foreach($request->all() as $key => $req) {
            if ($key == '_token' || $key == 'password' || $key == 'letterhead') {
                continue;
            }
            $company[$key] = $req;
        }

        if ($request->hasFile('letterhead')) {
            $file = $request->file('letterhead');
            $fileName = $file->getClientOriginalName();
            $uploadPath = public_path('uploads/letterhead');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($file->move($uploadPath, $fileName)) {
                $company->letterhead = $fileName;
            } else {
                session()->flash('error', 'Kesalahan terjadi, perusahaan baru gagal disimpan, harap hubungi Admin kami');
                return redirect()->route('company');
            }
        }

        if ($company->save()) {
        } else {
            session()->flash('error', 'Kesalahan terjadi, perusahaan baru gagal disimpan, harap hubungi Admin kami');
            return redirect()->route('company');
        }
        

        $user = new User;
        $user->name = $request->pic_name;
        $user->email = $request->pic_email;
        $user->phone_number = $request->pic_phone_number;
        $user->password = Hash::make($request->password);
        $user->id_role = 2;
        $user->id_company = $company->company_id;

        if ($user->save()) {
        } else {
            session()->flash('error', 'Kesalahan terjadi, perusahaan baru gagal disimpan, harap hubungi Admin kami');
            return redirect()->route('company');
        }

        session()->flash('success', 'Perusahaan baru telah disimpan');
        return redirect()->route('company');
    }

    public function delete($id)
    {
        $company = companyM::find($id);
        $user = User::where("id_company", $company->company_id);
        $program = McuProgramM::where("company_id", $company->company_id);
        $departement = DepartementM::where("company_id", $company->company_id);
        $employee = EmployeeM::where("company_id", $company->company_id);
        $mcu = McuT::where("company_id", $company->company_id);

        if ($company->delete() && $user->delete() && $program->delete() && $departement->delete() && $employee->delete() && $mcu->delete()) {
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
        $company = companyM::find($id);
        
        if ($company) {
            $data['company'] = $company;

            return view('company/detail', $data);
        } else {
            return view('errors/404');
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'company_name' => 'required',
            'company_code' => 'required',
            'npwp_company_number' => 'required',
            'pic_name' => 'required',
            'pic_email' => 'required|email',
            'pic_phone_number' => 'required|numeric',
            'company_address' => 'required',
        ];

        $messages = [
            'company_name.required' => 'Nama Perusahaan wajib diisi',
            'company_code.required' => 'Kode Perusahaan wajib diisi',
            'npwp_company_number.required' => 'NPWP Perusahaan wajib diisi',
            'pic_name.required' => 'Nama PIC wajib diisi',
            'pic_email.required' => 'Email PIC wajib diisi',
            'pic_email.email' => 'Email PIC tidak valid',
            'pic_phone_number.required' => 'No Telp PIC wajib diisi',
            'pic_phone_number.numeric' => 'No Telp PIC harus berupa angka',
            'company_address.required' => 'Alamat Perusahaan wajib diisi',
        ];

        $id = $request->id;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('company.detail', ['id' => $id]);
        }

        $company = companyM::find($id);
        foreach($request->all() as $key => $req) {
            if ($key == '_token' || $key == 'id') {
                continue;
            }
            $company[$key] = $req;
        }

        if ($request->hasFile('letterhead')) {
            $file = $request->file('letterhead');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileSizeInKB = $fileSize / 1024;
            $uploadPath = public_path('uploads/letterhead');

            if ($fileSizeInKB > 100) {
                session()->flash('error', 'Ukuran file Kop Surat maksimal 100Kb');
                return redirect()->route('company');
            }

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($file->move($uploadPath, $fileName)) {
                $company->letterhead = $fileName;
            } else {
                session()->flash('error', 'Kesalahan terjadi, perusahaan baru gagal disimpan, harap hubungi Admin kami');
                return redirect()->route('company');
            }
        }

        $user = User::where("id_company", $company->company_id)->first();
        $user->email = $request->pic_email;

        if ($company->save() && $user->save()) {
            session()->flash('success', 'Perusahaan diperbarui');
            return redirect()->route('company.detail', ['id' => $id]);
        } else {
            session()->flash('success', 'Kesalahan terjadi, perusahaan gagal diperbarui. Harap hubungi Admin kamu');
            return redirect()->route('company.detail', ['id' => $id]);
        }

    }

    public function reset(Request $request)
    {
        $rules = [
            'company_id' => 'required',
            'password_reset' => 'required',
        ];

        $messages = [
            'company_id.required' => 'Perusahaan tidak dipilih',
            'password_reset.required' => 'Password baru wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('company');
        }

        $user = User::where('id_company', $request->company_id)->first();
        if ($user) {
            $user->password = Hash::make($request->password_reset); 
        } else {
            session()->flash('error', 'PIC tidak ditemukan');
        }
        
        if ($user->save()) {
            session()->flash('success', 'Password PIC berhasil direset');
        } else {
            session()->flash('error', 'Kesalahan terjadi, Password PIC gagal direset, harap hubungi Admin kami');
        }

        return redirect()->route('company');
    }
}
