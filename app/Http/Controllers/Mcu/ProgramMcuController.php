<?php

namespace App\Http\Controllers\Mcu;

use App\Helpers\ConstantsHelper;
use App\Http\Controllers\Controller;
use App\Imports\McuAnamnesisImport;
use App\Imports\McuAudiometryImport;
use App\Imports\McuEkgImport;
use App\Imports\McuLaboratoryImport;
use App\Imports\McuPapsmearImport;
use App\Imports\McuRefractionImport;
use App\Imports\McuResumeMcuImport;
use App\Imports\McuRontgenImport;
use App\Imports\McuSpirometryImport;
use App\Imports\McuTreadmillImport;
use App\Imports\McuUsgImport;
use App\Models\AudiometryT;
use App\Models\CompanyM;
use App\Models\EkgT;
use App\Models\EmployeeM;
use App\Models\LookupC;
use App\Models\McuCompanyV;
use App\Models\McuEmployeeV;
use App\Models\McuProgramM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\RefractionT;
use App\Models\RontgenT;
use App\Models\SpirometryT;
use App\Models\TreadmillT;
use App\Models\UsgT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use ZipArchive;
use Validator;

class ProgramMcuController extends Controller
{
    public function index()
    {
        $company = CompanyM::all();
        $data['company'] = $company;
        return view('/mcu/program_mcu', $data);
    }

    public function getDataMcuProgramCompany(Request $request, $company_id)
    {
        try {
            $auth = Auth::user();
            if ($auth->id_role == 2) {
                $company_id = $auth->id_company;
            } else {
                if ($company_id == 'A') {
                    $company_id = NULL;
                }
            }

            $model = new McuCompanyV();
            $query = $model->select();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('mcu_program_name', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('company_name', 'ilike', '%' . $searchValue . '%');
                });
            }

            if ($company_id !== NULL) {
                $query->where('company_id', $company_id);
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

    public function detailProgramMcu(Request $request)
    {
        $company_id = $request->get('company_id');
        $mcu_program_id = $request->get('mcu_program_id');
        $employees = EmployeeM::select('employee_id', 'employee_code', 'employee_name')->where('company_id', $company_id)->get();
        $packages = PackageM::select('id', 'package_code', 'package_name')->get();

        $company_name = CompanyM::where('company_id', $company_id)->value('company_name');
        // $mcu_program_name = McuProgramM::where('mcu_program_id', $mcu_program_id)->value('mcu_program_name');
        $mcu_program_name = McuProgramM::where('mcu_program_id', $mcu_program_id)->first();
        $mcu_sum = McuT::where('company_id', $company_id)
            ->where('mcu_program_id', $mcu_program_id)
            ->count();

        $employee_sum = McuT::where('company_id', $company_id)
            ->where('mcu_program_id', $mcu_program_id)
            ->distinct('employee_id')
            ->count('employee_id');

        $examination_type = LookupC::select('lookup_id as examination_type_id', 'lookup_name as examination_type_name')->where('lookup_type', ConstantsHelper::LOOKUP_EXAMINATION_TYPE)->get();

        return view('/mcu/detail_program_mcu', get_defined_vars());
    }

    public function getDataMcuEmployee(Request $request)
    {
        try {
            $company_id = $request->get('company_id');
            $mcu_program_id = $request->get('mcu_program_id');
            $model = new McuEmployeeV();
            $query = $model->select();
            $query = $query->where('company_id', $company_id)->where('mcu_program_id', $mcu_program_id)->where('deleted_at', null);
            $totalRecords = $query->count();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('employee_name', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('departement_name', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('mcu_code', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('nik', 'ilike', '%' . $searchValue . '%');
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

    public function insertManualMcu(Request $request)
    {
        $company_id = $request->get('company_id');
        $mcu_program_id = $request->get('mcu_program_id');
        $employees = EmployeeM::select('employee_id', 'employee_code', 'employee_name')->where('company_id', $company_id)->get();
        return view('/mcu/insert_manual_mcu', get_defined_vars());
    }

    public function actionInsertManualMcu(Request $request)
    {
        try {
            $post = $request->post();
            $company_id = $post['company_id'];
            $mcu_program_id = $post['mcu_program_id'];
            DB::beginTransaction();
            $model = new McuT();
            unset($post['_token']);
            $model->attributes = $post;
            if ($model->validate() === true) {
                if ($model->save()) {
                    DB::commit();
                    return redirect()->back()->with([
                        'success' => ConstantsHelper::MESSAGE_SUCCESS_SAVE
                    ]);
                }
            } else {
                DB::rollback();
                return redirect()->back()->with([
                    'error' => $model->validate()
                ]);
            }

            return redirect('/mcu/program-mcu/detail?company_id='.$company_id.'&mcu_program_id='.$mcu_program_id)->with('success', 'Form submitted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function importExcelAnamnesa(Request $request)
    {
        try{
            $post = $request->post();
            $request->validate([
                'examination_type' => 'required',
                'import_file' => [
                    'required',
                    'file',
                    'mimes:xls,xlsx',
                ],
                'mcu_date' => 'required',
                'company_id' => 'required',
                'mcu_program_id' => 'required',
            ], [
                'examination_type.required' => 'Jenis Pemeriksaan Tidak Boleh Kosong.',
                'import_file.required' => 'File Excel Tidak Boleh Kosong.',
                'import_file.file' => 'File Excel Tidak Valid.',
                'import_file.mimes' => 'File Excel Tidak Sesuai, Silahakn Upload File Berupa xls atau xlsx',
                'mcu_date.required' => 'Tanggal MCU Tidak Boleh Kosong.',
                'company_id.required' => 'ID Perusahaan Tidak Boleh Kosong.',
                'mcu_program_id.required' => 'ID Program MCU Tidak Boleh Kosong.',
            ]);

            $import_model = null;
            switch ($request->post('examination_type')) {
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_ANAMNESIS:
                    $import_model = new McuAnamnesisImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_REFRACTION:
                    $import_model = new McuRefractionImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_LAB:
                    $import_model = new McuLaboratoryImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RONTGEN:
                    $import_model = new McuRontgenImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_AUDIOMETRY:
                    $import_model = new McuAudiometryImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_SPIROMETRY:
                    $import_model = new McuSpirometryImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_EKG:
                    $import_model = new McuEkgImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_USG:
                    $import_model = new McuUsgImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_TREADMILL:
                    $import_model = new McuTreadmillImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_PAPSMEAR:
                    $import_model = new McuPapsmearImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RESUME_MCU:
                    $import_model = new McuResumeMcuImport($post['mcu_date'], $post['company_id'], $post['mcu_program_id']);
                    break;
                default:
                    return redirect()->back()->with('error', 'Jenis Pemeriksaan Salah!');
            }

            if ($import_model == null) {
                throw new \Exception('Terjadi Kesalahan!');
            }

            Excel::import($import_model, $request->file('import_file'));
            return redirect()->back()->with('success', 'Import Excel Berhasil');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function uploadHasil(Request $request)
    {
        try{
            $post = $request->post();
            $request->validate([
                'examination_type' => 'required',
                'import_file' => [
                    'required',
                    'file',
                    'mimes:zip',
                ],
                'company_id' => 'required',
                'mcu_program_id' => 'required',
            ], [
                'examination_type.required' => 'Jenis Pemeriksaan Tidak Boleh Kosong.',
                'import_file.required' => 'File ZIP Tidak Boleh Kosong.',
                'import_file.file' => 'File ZIP Tidak Valid.',
                'import_file.mimes' => 'File ZIP Tidak Sesuai, Silahakn Upload File Berupa ZIP',
                'company_id.required' => 'ID Perusahaan Tidak Boleh Kosong.',
                'mcu_program_id.required' => 'ID Program MCU Tidak Boleh Kosong.',
            ]);

            $zipFile = $request->file('import_file');
            $zipPath = $zipFile->store('temp');
            $extractPath = null;
            $model = null;
            switch ($request->post('examination_type')) {
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_REFRACTION:
                    $model = new RefractionT();
                    $extractPath = 'uploads/refraction/extract/';
                    $imagePath = 'uploads/refraction/';
                    $category = 'refraksi';
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RONTGEN:
                    $model = new RontgenT();
                    $extractPath = 'uploads/rontgen/extract/';
                    $imagePath = 'uploads/rontgen/';
                    $category = 'rontgen';
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_AUDIOMETRY:
                    $model = new AudiometryT();
                    $extractPath = 'uploads/audiometry/extract/';
                    $imagePath = 'uploads/audiometry/';
                    $category = 'audiometry';
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_SPIROMETRY:
                    $model = new SpirometryT();
                    $extractPath = 'uploads/spirometry/extract/';
                    $imagePath = 'uploads/epirometry/';
                    $category = 'spirometry';
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_EKG:
                    $model = new EkgT();
                    $extractPath = 'uploads/ekg/extract/';
                    $imagePath = 'uploads/ekg/';
                    $category = 'ekg';
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_USG:
                    $model = new UsgT();
                    $extractPath = 'uploads/usg/extract/';
                    $imagePath = 'uploads/usg/';
                    $category = 'usg';
                    break;
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_TREADMILL:
                    $model = new TreadmillT();
                    $extractPath = 'uploads/treadmill/';
                    $category = 'treadmill';
                    break;
                default:
                    return redirect()->back()->with('error', 'Jenis Pemeriksaan Salah!');
            }

            $zip = new ZipArchive;
            if ($zip->open(storage_path('app/' . $zipPath)) === true) {
                $zip->extractTo($extractPath);
                $zip->close();
            } else {
                throw new \Exception('Terjadi Kesalahan!');
            }

            $files = scandir($extractPath);
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            foreach ($files as $key => $file) {
                $filePath = $extractPath . '/' . $file;
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (!in_array($extension, $allowedExtensions) || !is_file($filePath)) {
                    unset($files[$key]);
                }
            }

            foreach ($files as $file) {
                $filePath = $extractPath . $file;
                if ($file == '.' || $file == '..') {
                    continue;
                }

                if (in_array($file, ['.DS_Store', '.git', 'Thumbs.db'])) {
                    unset($files[$file]);
                    continue;
                }

                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $pattern = '/^\d+_[A-Za-z0-9]+_' . preg_quote($category, '/') . '$/i';
                if (in_array(strtolower($extension), $allowedExtensions) && is_file($filePath) && preg_match($pattern, $fileName)) {

                    $filename = $fileName . '.' . $extension;
                    $storedPath = $imagePath . $filename;

                    $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);  // Get the filename without extension
                    $nik = explode('_', $fileNameWithoutExtension)[0];
                    $packageCode = explode('_', $fileNameWithoutExtension)[1];

                    $employeeModel = EmployeeM::select('employee_id')->where('nik', $nik)->first();
                    $packageModel = PackageM::select('id')->where('package_code', $packageCode)->first();

                    if ($employeeModel == null) {
                        throw new \Exception('Terjadi Kesalahan! Peserta dengan nik '.$nik.' Tidak Ditemukan!');
                    }
                    if ($packageModel == null) {
                        throw new \Exception('Terjadi Kesalahan! Kode paket '.$packageCode.' Tidak Ditemukan!');
                    }

                    if (!is_dir($imagePath)) {
                        mkdir($imagePath, 0755, true);
                    }
                    $filename = Str::uuid().'.'.$extension;
                    File::move($extractPath.$file, $imagePath . $filename);

                    $modelMcu = McuT::select('mcu_id')
                        ->where('employee_id', $employeeModel->employee_id)
                        ->where('company_id', $post['company_id'])
                        ->where('mcu_program_id', $post['mcu_program_id'])
                        ->where('is_import', true)
                        ->where('package_id', $packageModel->id)
                        ->first();
                    Log::info($modelMcu);

                    if ($modelMcu == null) {
                        // throw new \Exception('Peserta dengan nik '.$nik.' dan kode paket '.$packageCode.' belum memiliki mcu, silahkan input mcu terlebih dahulu atau melalui import excel!');
                        McuT::insert([
                            'mcu_date' => date('Y-m-d H:i:s'),
                            'employee_id' => $employeeModel->employee_id,
                            'company_id' => $post['company_id'],
                            'mcu_program_id' => $post['mcu_program_id'],
                            'is_import' => true,
                            'package_id' => $packageModel->id
                        ]);
                        $modelMcuNew = McuT::select('mcu_id')
                            ->where('employee_id', $employeeModel->employee_id)
                            ->where('company_id', $post['company_id'])
                            ->where('mcu_program_id', $post['mcu_program_id'])
                            ->where('is_import', true)
                            ->where('package_id', $packageModel->id)
                            ->first();
                        $mcu_id = $modelMcuNew->mcu_id;
                    } else {
                        $mcu_id = $modelMcu->mcu_id;
                    }
                    $images = [];
                    $images[] = $filename;
                    $payload = [
                        'mcu_id' => $mcu_id,
                        'image_file' => json_encode($images),
                    ];
                    $existingRecord = $model->where('mcu_id', $mcu_id)->first();
                    if ($existingRecord) {
                        $existingRecord->update($payload);
                    } else {
                        $payload['is_import'] = true;
                        $model->insert($payload);
                        // throw new \Exception('Peserta dengan nik '.$nik.' dan kode paket '.$packageCode.' belum memiliki pemeriksaan '.$category.', silahkan input terlebih dahulu atau melalui import excel!');
                    }
                } else {
                    throw new \Exception('Nama file tidak sesuai!');
                }
            }
            Storage::delete($zipPath);
            return redirect()->back()->with('success', 'Upload Hasil Skses');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function saveConclusionSuggestion(Request $request)
    {
        $rules = [
            'conclusion' => 'required',
            'suggestion' => 'required',
            'id' => 'required',
        ];

        $messages = [
            'conclusion.required' => 'Kesimpulan wajib diisi',
            'suggestion.required' => 'Saran wajib diisi',
            'id.required' => 'Program harus dipilih',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();

            session()->flash('error', $messages);

            return redirect()->back();
        }

        $program = McuProgramM::find($request->id);
        $program->conclusion = $request->conclusion;
        $program->suggestion = $request->suggestion;

        if($program->save()) {
            session()->flash('success', 'Kesimpulan dan Saran berhasil disimpan');
        } else {
            session()->flash('success', 'Kesalahan terjadi, harap hubungi admin kami');
        }

        return redirect()->back();
    }

    public function saveProgram(Request $request)
    {
        $rules = [
            'company_id' => 'required',
            'mcu_program_code' => 'required',
            'mcu_program_name' => 'required',
        ];

        $messages = [
            'company_id.required' => 'Nama Perusahaan wajib diisi',
            'mcu_program_code.required' => 'Kode Program wajib diisi',
            'mcu_program_name.required' => 'Nama Program wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();

            session()->flash('error', $messages);

            return redirect()->route('program-mcu');
        }

        $program = new McuProgramM;

        foreach ($request->all() as $k => $r) {
            if ($k == '_token') {
                continue;
            }

            $program->$k = $r;
        }

        if ($program->save()) {
            session()->flash('success', 'Program baru telah disimpan');
            return redirect()->route('program-mcu');
        } else {
            session()->flash('success', 'Kesalahan terjadi, program gagal disimpan, harap hubungi Admin kami');
            return redirect()->route('program-mcu');
        }
    }

    public function getProgramName($id)
    {
        $program = McuProgramM::find($id);

        if ($program == null) {
            $data = [
                'status' => 'error',
                'message' => 'Request Failed',
                'data' => 'Program tidak ditemukan',
            ];

        } else {
            $data = [
                'status' => 'success',
                'message' => 'Request Success',
                'data' => $program,
            ];
        }

        return response()->json($data, 200);
    }

    public function updateProgram(Request $request)
    {
        $rules = [
            'mcu_program_id' => 'required',
            'mcu_program_code' => 'required',
            'mcu_program_name' => 'required',
        ];

        $messages = [
            'mcu_program_id.required' => 'Program wajib dipilih',
            'mcu_program_code.required' => 'Kode Program wajib diisi',
            'mcu_program_name.required' => 'Nama Program wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();

            session()->flash('error', $messages);

            return redirect()->route('program-mcu');
        }

        $program = McuProgramM::find($request->mcu_program_id);

        foreach ($request->all() as $k => $r) {
            if ($k == '_token' || $k == 'mcu_program_id') {
                continue;
            }

            $program->$k = $r;
        }

        if ($program->save()) {
            session()->flash('success', 'Program telah diperbarui');
            return redirect()->route('program-mcu');
        } else {
            session()->flash('success', 'Kesalahan terjadi, program gagal diperbarui, harap hubungi Admin kami');
            return redirect()->route('program-mcu');
        }
    }
}
