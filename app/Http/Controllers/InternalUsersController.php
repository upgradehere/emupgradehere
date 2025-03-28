<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LookupC;
use Validator;
use Session;

class InternalUsersController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $examinations = LookupC::where('lookup_type', 'examination_type')->get();
        $data['examinations'] = $examinations;
        
        return view('internal-users/index', $data);
    }

    public function data(Request $request)
    {
        try {
            $model = new User();
            $query = $model->select();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('name', 'ilike', '%' . $searchValue . '%')
                    ->orWhere('email', 'ilike', '%' . $searchValue . '%');
                });
            }

            $query->whereNotIn('id_role', [2, 5]);

            if ($request->has('order') && is_array($request->order)) {
                foreach ($request->order as $order) {
                    $columnIndex = $order['column'];
                    $columnName = $request->columns[$columnIndex]['data'];
                    $direction = $order['dir'];
                    $query = $query->orderBy($columnName, $direction);
                }
            }
           
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $data = $query->offset($start)->limit($length)->get();

            // Map additional fields
            $data = $data->map(function ($item) {
                if ($item->id_role == 1) {
                    $item->role = 'Super Admin';
                    if ($item->id_company != NULL) {
                        $item->role = 'Small Admin';
                    }
                } else if ($item->id_role == 3) {
                    $item->role = 'Checker';
                } else if ($item->id_role == 4) {
                    $item->role = 'CSO';
                }

                return $item;
            });

            $totalRecords = $model->count();
            $filteredRecords = $query->count();

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
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
            'id_role' => 'required',
            'examination_type' => 'required_if:id_role,3',
        ];
        
        $messages = [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'phone_number.required' => 'No Telp wajib diisi',
            'password.required' => 'Password wajib diisi',
            'id_role.required' => 'Role wajib diisi',
            'examination_type.required_if' => 'Examination Type wajib diisi jika role yang dipilih adalah Checker',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('doctor');
        }

        $user = new User;
        foreach ($request->all() as $k => $r) {
            if ($k != '_token') {
                if ($k == 'password') {
                    $user->$k = Hash::make($request->password);
                } else {
                    $user->$k = $r;
                }
            }
        }

        if($user->save()) {
            session()->flash('success', 'Internal User berhasil disimpan');
        } else {
            session()->flash('error', 'Kesalahan terjadi, Internal User gagal disimpan, harap hubungi Admin kami');
        }

        return redirect()->route('internal-users');
        
    }

    public function delete($id)
    {
        $doctor = DoctorM::find($id);

        if ($doctor->delete()) {
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
        $doctor = DoctorM::find($id);
        
        if ($doctor) {
            $data['doctor'] = $doctor;
            
            return view('doctor/detail', $data);
        } else {
            return view('errors/404');
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'doctor_name' => 'required',
            'doctor_code' => 'required',
        ];

        $messages = [
            'id.required' => 'Dokter tidak dipilih',
            'doctor_name.required' => 'Nama Dokter wajib diisi',
            'doctor_code.required' => 'Kode Dokter wajib diisi',
        ];

        $id = $request->id;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('doctor.detail', ['id' => $id]);
        }

        $doctor = DoctorM::find($id);

        if ($doctor) {
            foreach ($request->all() as $k => $r) {
                if ($k != '_token' && $k != 'id' && $k != 'doctor_sign') {
                    $doctor->$k = $r;
                }
            }

            if ($request->hasFile('doctor_sign')) {
                $file = $request->file('doctor_sign');
                $fileName = $file->getClientOriginalName();
                $fileSize = $file->getSize();
                $fileSizeInKB = $fileSize / 1024;
                $uploadPath = public_path('uploads/doctor_sign');
                
                if ($fileSizeInKB > 100) {
                    session()->flash('error', 'Ukuran file TTD Dokter maksimal 100Kb');
                    return redirect()->route('doctor');
                }

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
    
                if ($file->move($uploadPath, $fileName)) {
                    $doctor->doctor_sign = $fileName;
                } else {
                    session()->flash('error', 'Kesalahan terjadi, dokter baru gagal disimpan, harap hubungi Admin kami');
                    return redirect()->route('doctor');
                }
            }
    
            if($doctor->save()) {
                session()->flash('success', 'Dokter baru berhasil disimpan');
            } else {
                session()->flash('error', 'Kesalahan terjadi, Dokter baru gagal disimpan, harap hubungi Admin kami');
            }
        } else {
            session()->flash('error', 'Dokter tidak ditemukan');
        }

        return redirect()->route('doctor');
    }
}
