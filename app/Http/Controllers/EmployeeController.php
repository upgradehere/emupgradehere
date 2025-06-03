<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\EmployeeImport;
use App\Helpers\GlobalHelper;
use App\Models\User;
use App\Models\EmployeeM;
use App\Models\CompanyM;
use App\Models\DepartementM;
use Carbon\Carbon;
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
            // 'employee_code' => 'required',
            'nik' => 'required|numeric',
            // 'phone_number' => 'required|numeric',
            // 'email' => 'required|email',
            'dob' => 'required',
            'sex' => 'required',
            'departement_id' => 'required',
        ];

        $messages = [
            'company_id.required' => 'Perusahaan wajib diisi',
            'employee_name.required' => 'Nama Pegawai wajib diisi',
            // 'employee_code.required' => 'Kode Pegawai wajib diisi',
            'nik.required' => 'NIK wajib diisi',
            'nik.numeric' => 'NIK harus berupa angka',
            // 'phone_number.required' => 'No Whatsapp wajib diisi',
            // 'phone_number.numeric' => 'No Whatsapp harus berupa angka',
            // 'email.required' => 'Email wajib diisi',
            // 'email.email' => 'Email tidak valid',
            'dob.required' => 'Tanggal Lahir wajib diisi',
            'sex.required' => 'Jenis Kelamin wajib diisi',
            'departement_id.required' => 'Departemen wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();

            session()->flash('error', $messages);

            return redirect()->route('employee', ['company-id' => $request->company_id]);
        }

        if (empty($request->email)) {
            $email = str_replace(' ', '_', $request->employee_name);
            $request->merge(['email' => $email]);
        }

        $check = EmployeeM::where('nik', $request->nik)->get();
        if ($check->count() > 0) {
            session()->flash('error', 'NIK yang sama sudah ada');
            return redirect()->route('employee', ['company-id' => $request->company_id]);
        }

        $check2 = EmployeeM::where('email', $request->email)->get();
        $check3 = User::where('email', $request->email)->get();
        if ($check2->count() > 0 || $check3->count() > 0) {
            session()->flash('error', 'Email yang sama sudah ada');
            return redirect()->route('employee', ['company-id' => $request->company_id]);
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
                return redirect()->route('employee', ['company-id' => $employee->company_id]);
            }
        }

        if($employee->save()) {
            $pw = Carbon::parse($employee->dob)->format('Y-m-d');
    
            $user = new User;
            $user->name = $employee->employee_name;
            $user->email = $employee->email;
            $user->phone_number = $employee->phone_number;
            $user->password = Hash::make($pw);
            $user->otp = NULL;
            $user->otp_expired = NULL;
            $user->id_role = 5;
            $user->id_company = $employee->company_id;
            $user->id_employee = $employee->employee_id;
            $user->examination_type = NULL;

            if ($user->save()) {
                session()->flash('success', 'Pegawai baru berhasil disimpan');
            }
        } else {
            session()->flash('error', 'Kesalahan terjadi, pegawai gagal disimpan, harap hubungi Admin kami');
        }

        return redirect()->route('employee', ['company-id' => $employee->company_id]);

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
            // 'employee_code' => 'required',
            'nik' => 'required|numeric',
            // 'phone_number' => 'required|numeric',
            // 'email' => 'required|email',
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
            // 'email.required' => 'Email wajib diisi',
            // 'email.email' => 'Email tidak valid',
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

        return redirect()->route('employee', ['company-id' => $employee->company_id]);
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

    public function deleteFolder($folderPath)
    {
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

    public function importEmployee(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:xls,xlsx|max:51200',
            'company_id' => 'required',
        ];

        $messages = [
            'file.required' => 'File wajib dipilih',
            'file.file' => 'File harus file',
            'file.mimes' => 'File harus berupa xls / xlsx',
            'file.max' => 'File tidak boleh berukuran lebih dari 50MB',
            'company_id.required' => 'Perusahaan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();

            session()->flash('error', $messages);

            return redirect()->route('employee');
        }

        try {
            Excel::import(new EmployeeImport($request->company_id), $request->file('file'));

            session()->flash('success', 'Data pegawai berhasil diimport');
        } catch (\Exception $e) {
            session()->flash('error', 'Data pegawai gagal diimport, '.$e->getMessage());
        }

        return redirect()->route('employee');
    }

    public function devGenerateUserEmp($company_id)
    {
        $employee = EmployeeM::where("company_id", $company_id)->get();

        // $inc = 1;
        foreach($employee as $emp) {
            // if ($inc == 10) {
            //     break;
            // }
            $user = User::where("name", $emp->employee_name)
                        ->where("id_role", 5)
                        ->where("id_company", $company_id)
                        ->first();
            
            if (!$user) {
                $new = new User;

                $pw = Carbon::parse($emp->dob)->format('Y-m-d');

                $new->name = $emp->employee_name;
                $new->email = (!empty($emp->email)) ? $emp->email : str_replace(" ","_",$emp->employee_name);
                $new->phone_number = $emp->phone_number;
                $new->password = Hash::make($pw);
                $new->otp = NULL;
                $new->otp_expired = NULL;
                $new->id_role = 5;
                $new->id_company = $emp->company_id;
                $new->id_employee = $emp->employee_id;
                $new->examination_type = NULL;

                $check = User::where("email", $new->email)->first();
                if ($check) {
                    //
                } else {
                    if ($new->save()) {
                        echo 'SUCCESS : employee id : '.$emp->id.'<br>'.$new->id.'<br><br>';
                    } else {
                        echo 'FAILED : employee id : '.$emp->id.'<br>'.$new->id.'<br><br>';
                    }
                }
            }

            // $inc++;
        }
    }
}
