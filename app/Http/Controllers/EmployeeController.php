<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Models\EmployeeM;
use App\Models\CompanyM;
use App\Models\DepartementM;
use Validator;
use Session;
use ZipArchive;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['company_id'] = 'A';

        if ($request->get('company-id')) {
            if (is_numeric($request->get('company-id'))) {
                $data['company_id'] = $request->get('company-id');
            }
        }

        $company = CompanyM::all();
        $data['company'] = $company;

        return view('employee/index', $data);
    }

    public function data(Request $request, $company_id)
    {
        try {
            $model = new EmployeeM;
            
            $query = $model->with('company');
            
            if ($company_id !== 'A') {
                $query->where('company_id', $company_id);
            }

            return response()->json(GlobalHelper::dataTable($request, $query));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }

    }

    public function store(Request $request)
    {
        $rules = [
            'company_id' => 'required',
            'employee_name' => 'required',
            'employee_code' => 'required',
            'nik' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'dob' => 'required',
            'sex' => 'required',
            'departement_id' => 'required',
        ];

        $messages = [
            'company_id.required' => 'Perusahaan wajib diisi',
            'employee_name.required' => 'Nama Pegawai wajib diisi',
            'employee_code.required' => 'Kode Pegawai wajib diisi',
            'nik.required' => 'NIK wajib diisi',
            'nik.numeric' => 'NIK harus berupa angka',
            'phone_number.required' => 'No Whatsapp wajib diisi',
            'phone_number.numeric' => 'No Whatsapp harus berupa angka',
            'email.required' => 'Email wajib diisi',
            'email.numeric' => 'Email tidak valid',
            'dob.required' => 'Tanggal Lahir wajib diisi',
            'sex.required' => 'Jenis Kelamin wajib diisi',
            'departement_id.required' => 'Departemen wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('employee');
        }

        $check = EmployeeM::where('nik', $request->nik)->get();
        if ($check->count() > 0) {
            session()->flash('error', 'NIK yang sama sudah ada');
            return redirect()->route('employee');
        }

        $employee = new EmployeeM;
        foreach ($request->all() as $k => $r) {
            if ($k != '_token') {
                $employee->$k = $r;
            }
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $uploadPath = public_path('uploads/employee-photo');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($file->move($uploadPath, $fileName)) {
                $employee->photo = $fileName;
            } else {
                session()->flash('error', 'Kesalahan terjadi, pegawai baru gagal disimpan, harap hubungi Admin kami');
                return redirect()->route('employee');
            }
        }

        if($employee->save()) {
            session()->flash('success', 'Pegawai baru berhasil disimpan');
        } else {
            session()->flash('error', 'Kesalahan terjadi, pegawai gagal disimpan, harap hubungi Admin kami');
        }

        return redirect()->route('employee');
        
    }

    public function delete($id)
    {
        $employee = EmployeeM::find($id);

        if ($employee->delete()) {
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
        $employee = EmployeeM::with('company')->where('employee_id',$id)->first();
        $company = CompanyM::all();
        $departement = DepartementM::where("company_id", $employee->company_id)->get();
        
        if ($employee) {
            $data['employee'] = $employee;
            $data['company'] = $company;
            $data['departement'] = $departement;
            
            return view('employee/detail', $data);
        } else {
            return view('errors/404');
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'company_id' => 'required',
            'employee_name' => 'required',
            'employee_code' => 'required',
            'nik' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'dob' => 'required',
            'sex' => 'required',
            'departement_id' => 'required',
        ];

        $messages = [
            'id.required' => 'Pegawai tidak dipilih',
            'company_id.required' => 'Perusahaan wajib diisi',
            'employee_name.required' => 'Nama Pegawai wajib diisi',
            'employee_code.required' => 'Kode Pegawai wajib diisi',
            'nik.required' => 'NIK wajib diisi',
            'nik.numeric' => 'NIK harus berupa angka',
            'phone_number.required' => 'No Whatsapp wajib diisi',
            'phone_number.numeric' => 'No Whatsapp harus berupa angka',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus berupa angka',
            'dob.required' => 'Tanggal Lahir wajib diisi',
            'sex.required' => 'Jenis Kelamin wajib diisi',
            'departement_id.required' => 'Departemen wajib diisi',
        ];

        $id = $request->id;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('employee.detail', ['id' => $id]);
        }

        $employee = EmployeeM::find($id);

        if ($employee) {
            foreach ($request->all() as $k => $r) {
                if ($k != '_token' && $k != 'id') {
                    $employee->$k = $r;
                }
            }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = $file->getClientOriginalName();
                $uploadPath = public_path('uploads/employee-photo');
    
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
    
                if ($file->move($uploadPath, $fileName)) {
                    $employee->photo = $fileName;
                } else {
                    session()->flash('error', 'Kesalahan terjadi, pegawai baru gagal disimpan, harap hubungi Admin kami');
                    return redirect()->route('employee');
                }
            }
    
            if($employee->save()) {
                session()->flash('success', 'Pegawai baru berhasil diperbarui');
            } else {
                session()->flash('error', 'Kesalahan terjadi, pegawai gagal diperbarui, harap hubungi Admin kami');
            }
        } else {
            session()->flash('error', 'Pegawai tidak ditemukan');
        }

        return redirect()->route('employee');
    }

    public function importPhoto(Request $request)
    {
        $arrNik = [];
        $zipFile = $request->file('photos');

        $validator = Validator::make($request->all(), [
            'photos' => 'required|file|mimes:zip|max:51200', // 50MB in KB
        ]);
        
        // Check if validation fails
        if ($validator->fails()) {
            session()->flash('error', 'File harus berupa Zip dan tidak boleh melebihi 50MB');
            return redirect()->route('employee');
        }

        $zipPath = $zipFile->move(public_path('uploads/temp'), $zipFile->getClientOriginalName());
        $extractPath = public_path('uploads/temp-employee-photo');
        $targetPath = public_path('uploads/employee-photo');

        if (!is_dir($extractPath)) {
            mkdir($extractPath, 0755, true);
        }
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        $zip = new ZipArchive;

        if ($zip->open($zipPath) === true) {
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            session()->flash('error', 'Kesalahan terjadi, file zip gagal di ekstrak. Harap hubungi Admin kami.');

            return redirect()->route('employee');
        }

        $files = scandir($extractPath);
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        foreach ($files as $key => $file) {
            $filePath = $extractPath . '/' . $file;
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            if (!in_array($extension, $allowedExtensions) || !is_file($filePath)) {
                continue;
            }

            $nik = pathinfo($file, PATHINFO_FILENAME);
            $newPath = $targetPath . '/' . $file;

            $employee = EmployeeM::where('nik', $nik)->first();
            if ($employee) {
                if (!rename($filePath, $newPath)) {
                    session()->flash('error', 'Kesalahan terjadi, foto pegawai gagal diimport. Harap hubungi Admin kami.');
    
                    return redirect()->route('employee');
                }

                $employee->photo = $file;
                if ($employee->save()) {
    
                } else {
                    session()->flash('error', 'Kesalahan terjadi, foto pegawai gagal diimport. Harap hubungi Admin kami.');
    
                    return redirect()->route('employee');
                }
            } else {
                unlink($filePath);
                array_push($arrNik, $nik);
            }

        }

        unlink($zipPath);

        $macosxFolder = $extractPath . '/__MACOSX';
        if (is_dir($macosxFolder)) {
            $this->deleteFolder($macosxFolder);
        }

        session()->flash('success', 'Foto pegawai berhasil diimport');
        if (!empty($arrNik)) {
            session()->flash('swal', $arrNik);
        }

        return redirect()->route('employee');
    }

    public function deleteFolder($folderPath) {
        if (is_dir($folderPath)) {
            $files = array_diff(scandir($folderPath), ['.', '..']);
            foreach ($files as $file) {
                $filePath = $folderPath . '/' . $file;
                if (is_dir($filePath)) {
                    deleteFolder($filePath);
                } else {
                    unlink($filePath);
                }
            }
            rmdir($folderPath);
        }
    }
}
