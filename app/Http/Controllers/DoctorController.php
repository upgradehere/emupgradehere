<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorM;
use Validator;
use Session;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        return view('doctor/index');
    }

    public function data(Request $request)
    {
        try {
            $model = new DoctorM();
            $query = $model->select();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('doctor_name', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('doctor_code', 'ilike', '%' . $searchValue . '%');
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
           
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $data = $query->offset($start)->limit($length)->get();
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
            'doctor_name' => 'required',
            'doctor_code' => 'required',
            'doctor_sign' => [
                'required',
                'file',
                'mimes:jpg,png',
                'max:200'
            ],
        ];

        $messages = [
            'doctor_name.required' => 'Nama Dokter wajib diisi',
            'doctor_code.required' => 'Kode Dokter wajib diisi',
            'doctor_sign.required' => 'File Ttd Dokter wajib diisi',
            'doctor_sign.mimes' => 'File Ttd Dokter hanya diperbolehkan tipe .jpg atau .png',
            'doctor_sign.max' => 'File Ttd Dokter melebihi batas maksimal 100kb',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('doctor');
        }

        $doctor = new DoctorM;
        foreach ($request->all() as $k => $r) {
            if ($k != '_token' && $k != 'doctor_sign') {
                $doctor->$k = $r;
            }
        }

        if ($request->hasFile('doctor_sign')) {
            $file = $request->file('doctor_sign');
            $fileName = $file->getClientOriginalName();
            $uploadPath = public_path('uploads/doctor_sign');

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

        return redirect()->route('doctor');
        
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
