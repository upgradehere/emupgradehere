<?php

namespace App\Http\Controllers\Mcu;

use App\Helpers\ConstantsHelper;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Imports\McuAnamnesisImport;
use App\Models\CompanyM;
use App\Models\DoctorM;
use App\Models\EmployeeM;
use App\Models\LookupC;
use App\Models\McuCompanyV;
use App\Models\McuEmployeeV;
use App\Models\McuProgramM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Traits\AnamnesisTrait;
use App\Traits\AudiometriTrait;
use App\Traits\EkgTrait;
use App\Traits\LaboratoriumTrait;
use App\Traits\PapsmearTrait;
use App\Traits\RefractionTrait;
use App\Traits\ResumeMcuTrait;
use App\Traits\RontgenTrait;
use App\Traits\SpirometriTrait;
use App\Traits\TreadmillTrait;
use App\Traits\UsgTrait;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Log;


class PemeriksaanMcuController extends Controller
{
    use AnamnesisTrait;
    use LaboratoriumTrait;
    use RefractionTrait;
    use RontgenTrait;
    use SpirometriTrait;
    use AudiometriTrait;
    use EkgTrait;
    use UsgTrait;
    use TreadmillTrait;
    use PapsmearTrait;
    use ResumeMcuTrait;

    public function __construct() {}

    public function index(Request $request)
    {
        $mcu_id = $request->get('mcu_id');
        $employee_id = $request->get('employee_id');

        $employee_data= EmployeeM::leftJoin('lookup_c', 'lookup_c.lookup_id', '=', 'employee_m.sex')
            ->where('employee_id', $employee_id)
            ->select('nik', 'employee_name', 'lookup_c.lookup_name as sex')
            ->first();

        $doctor_data = DoctorM::select('id', 'doctor_code', 'doctor_name', 'doctor_sign')->orderBy('id', 'asc')->get();

        $mcu_model = McuT::select('mcu_date', 'mcu_code', 'package_id')->where('mcu_id', $mcu_id)->first();
        $mcu_date = !empty($mcu_model['mcu_date']) ? date('Y-m-d', strtotime($mcu_model['mcu_date'])) : '-';
        $mcu_code = !empty($mcu_model['mcu_code']) ? $mcu_model['mcu_code'] : '-';
        $getPackage = GlobalHelper::getMcuPackage($mcu_model->package_id);
        $examinations = $getPackage['examinations'];
        $mcu_package_name = $getPackage['package_name'];
        $data_anamnesis = self::getDataAnamnesis($mcu_id);
        $laboratory_examintaions = !empty($getPackage['laboratory_examinations']) ? $getPackage['laboratory_examinations'] : [];
        $form_lab = self::getFormLab($mcu_id, $laboratory_examintaions);
        $data_refraction = self::getDataRefraction($mcu_id);
        $data_rontgen = self::getDataRontgen($mcu_id);
        $data_spirometry = self::getDataSpirometry($mcu_id);
        $data_ekg = self::getDataEkg($mcu_id);
        $data_usg = self::getDataUsg($mcu_id);
        $data_treadmill = self::getDataTreadmill($mcu_id);
        $data_papsmear = self::getDataPapsmear($mcu_id);
        $data_resume_mcu = self::getDataResumeMcu($mcu_id);
        $data_audiometry = self::getDataAudiometry($mcu_id);
        $kesimpulan_mcu_dropdown = LookupC::select('lookup_id', 'lookup_code', 'lookup_type', 'lookup_name')->where('lookup_type', ConstantsHelper::LOOKUP_KESIMPULAN_MCU)->get();

        return view('/mcu/pemeriksaan/index_pemeriksaan', get_defined_vars());
    }

    public function deletePemeriksaanMcu(Request $request)
    {
        try {
            $mcu_id = $request->get('mcu_id');
            if (empty($mcu_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = McuT::find($mcu_id);
            $model->delete();
            return redirect()->back()->with([
                'success' => ConstantsHelper::MESSAGE_SUCCESS_DELETE
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
            ]);
        }
    }

    public function cetakPemeriksaanMcu (Request $request)
    {
         $data = [
            'nik'           => '',
            'sex'           => '',
            'employee_name' => '',
            'age'           => '',
            'dob'           => '',
            'company_name'  => '',
            'mcu_date'      => '',
            'mcu_code'      => '',
            'letterhead'    => '',
            'photo'         => '',
            'anamnesis'     => [],
            'laboratorium'  => [],
            'refraksi'      => [],
            'rontgen'       => [],
            'audiometri'    => [],
            'spirometri'    => [],
            'ekg'           => [],
            'usg'           => [],
            'treadmill'     => [],
            'papsmear'      => [],
            'resume'        => [],
            'doctor_list'   => []
        ];

        try {
            $mcu_id = $request->get('mcu_id');
            $mcu_model = McuT::find($mcu_id);
            $doctors = DoctorM::all();
            $doctor_list = $doctors->pluck('doctor_name', 'id');
            $doctor_sign = $doctors->pluck('doctor_sign', 'id');
            $employee_model = EmployeeM::select('employee_m.employee_id',
                                            'employee_m.employee_code',
                                            'employee_m.employee_name',
                                            'employee_m.nik',
                                            'employee_m.company_id',
                                            'employee_m.departement_id',
                                            'employee_m.dob',
                                            'employee_m.phone_number',
                                            'employee_m.additional_data',
                                            'employee_m.sex',
                                            'employee_m.photo',
                                            'departement_m.departement_name')
                                        ->leftJoin('departement_m','employee_m.departement_id', 'departement_m.departement_id')
                                        ->where('employee_id', $mcu_model->employee_id)->first();
            $company_model  = CompanyM::select('*')->where('company_id', $mcu_model->company_id)->first();
            $anamnesis = self::getDataPrintAnamnesis($mcu_id);
            $laboratorium = self::getDataPrintLaboratorium($mcu_id);
            $refraksi = self::getDataPrintRefraction($mcu_id);
            $rontgen = self::getDataPrintRontgen($mcu_id);
            $audiometri = self::getDataPrintAudiometry($mcu_id);
            $spirometri = self::getDataPrintSpirometry($mcu_id);
            $ekg = self::getDataPrintEkg($mcu_id);
            $usg = self::getDataPrintUsg($mcu_id);
            $treadmill = self::getDataPrintTreadmill($mcu_id);
            $papsmear = self::getDataPrintPapsmear($mcu_id);
            $resume = self::getDataPrintResume($mcu_id);



            $letterhead = NULL;
            if (!empty($company_model->letterhead)) {
                $filePath = public_path('uploads/letterhead/'.$company_model->letterhead);
                if (File::exists($filePath)) {
                    $letterhead = $company_model->letterhead;
                } else {
                    Log::error('File letterhead tidak ditemukan di: ' . $filePath);
                }
            }

            $data = [
                'nik' => $employee_model->nik,
                'photo' => $employee_model->photo,
                'sex' => $employee_model->sex == '11' ? "LAKI-LAKI" : "PEREMPUAN" ,
                'employee_name' => $employee_model->employee_name,
                'age' => $employee_model->getUmur(),
                'dob' => date('Y/m/d', strtotime($employee_model->dob)),
                'company_name' => $company_model->company_name,
                'departement_name' => $employee_model->departement_name,
                'mcu_date' => date('Y/m/d', strtotime($mcu_model->mcu_date)),
                'mcu_code' => $mcu_model->mcu_code,
                'letterhead' => $letterhead,
                'anamnesis' => $anamnesis,
                'laboratorium' => $laboratorium,
                'refraksi' => $refraksi,
                'rontgen' => $rontgen,
                'audiometri' => $audiometri,
                'spirometri' => $spirometri,
                'ekg' => $ekg,
                'usg' => $usg,
                'treadmill' => $treadmill,
                'papsmear' => $papsmear,
                'resume' => $resume,
                'doctor_list' => $doctor_list,
                'doctor_sign' => $doctor_sign
            ];
        } catch (\Exception $e) {
            Log::error('Gagal generate MCU untuk mcu_id: ' . $request->get('mcu_id') . '. Error: ' . $e->getMessage(). ' file' . $e->getFile() . ' line' . $e->getLine());
        }

        $pdf = PDF::loadView('mcu.pemeriksaan.print.cetak_pemeriksaan', $data)->setPaper('a4', 'portrait');
        $filename = "MCU FILE.pdf";
        if (!empty($data['employee_name'])) {
            $filename = "MCU - ".$data['employee_name']. " - ".$data['mcu_code'].".pdf";
        }

        return $pdf->stream($filename);
    }

    public function sendBatchPemeriksaanMcu(Request $request)
    {
        $response = [];
        $mcu_program_id = $request->mcu_program_id;

        $mcus = McuT::with(['employee', 'company', 'program'])
                    ->where('mcu_program_id', $mcu_program_id)
                    ->get();

        if ($mcus) {
            if ($mcus->isNotEmpty()) {
                foreach($mcus as $mcu) {
                    if (!empty($mcu->employee->email)){
                        $mcu_id = Crypt::encryptString($mcu->mcu_id);
                        $data = [
                            'name' => $mcu->employee->employee_name,
                            'company' => $mcu->company->company_name,
                            'program' => $mcu->program->mcu_program_name,
                            'link' => route('open-email-pemeriksaan-mcu',['secret' => $mcu_id])
                        ];

                        try {
                            Mail::to($mcu->employee->email)->queue(new SendMail($data));
                        } catch(\Exception $e){
                            $response['status'] = 'error';
                            $response['data'] = 'Kesalahan terjadi, harap hubungi Admin kami.';
                            break;
                        }
                    }
                }
                $response['status'] = 'success';
                $response['data'] = 'Hasil Pemeriksaan MCU berhasil dikirim';
            } else {
                $response['status'] = 'success';
                $response['data'] = 'Belum ada data MCU untuk program ini';
            }
        } else {
            $response['status'] = 'error';
            $response['data'] = 'Kesalahan terjadi, harap hubungi Admin kami.';
        }

        return response()->json($response, 200);
    }

    public function sendSinglePemeriksaanMcu($mcuId)
    {
        $response = [];

        $mcu = McuT::with(['employee', 'company', 'program'])
                    ->where('mcu_id', $mcuId)
                    ->first();

        if ($mcu) {
            $mcu_id = Crypt::encryptString($mcuId);
    
            $data = [
                'name' => $mcu->employee->employee_name,
                'company' => $mcu->company->company_name,
                'program' => $mcu->program->mcu_program_name,
                'link' => route('open-email-pemeriksaan-mcu',['secret' => $mcu_id])
            ];
    
            try {
                Mail::to($mcu->employee->email)->queue(new SendMail($data));
                session()->flash('success', 'Hasil pemeriksaan berhasil dikirim');
            } catch(\Exception $e){
                session()->flash('error', 'Kesalahan terjadi, harap hubungi Admin kami.');
            }
        } else {
            session()->flash('warning', 'Data MCU tidak ditemukan');
        }

        return redirect()->back();
    }

    public function openEmailPemeriksaan($secret)
    {
        try {
            Crypt::decryptString($secret);
            $mcu_id = Crypt::decryptString($secret);

            $check = McuT::find($mcu_id);

            if ($check) {
                return redirect()->route('print-pemeriksaan-mcu', ['mcu_id' => $mcu_id]);
            } else {
                return view('errors.404');
            }
        } catch(\Exception $e){
            return view('errors.404');
        }
    }
}
