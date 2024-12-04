<?php

namespace App\Http\Controllers\Mcu;

use App\Helpers\ConstantsHelper;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Imports\McuAnamnesisImport;
use App\Models\CompanyM;
use App\Models\EmployeeM;
use App\Models\LookupC;
use App\Models\McuCompanyV;
use App\Models\McuEmployeeV;
use App\Models\McuProgramM;
use App\Models\McuT;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


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

    private $test = null;
    private $examination_package = [];

    public function __construct()
    {
        $this->test = 'test';
        $this->examination_package = GlobalHelper::getMcuPackage(1);
    }

    public function index(Request $request)
    {
        $mcu_id = $request->get('mcu_id');
        $employee_id = $request->get('employee_id');

        $employee_data= EmployeeM::leftJoin('lookup_c', 'lookup_c.lookup_id', '=', 'employee_m.sex')
            ->where('employee_id', $employee_id)
            ->select('nik', 'employee_name', 'lookup_c.lookup_name as sex')
            ->first();

        $examinations = $this->examination_package['examinations'];
        $mcu_model = McuT::select('mcu_date', 'mcu_code')->where('mcu_id', $mcu_id)->first();
        $mcu_date = !empty($mcu_model['mcu_date']) ? date('Y-m-d', strtotime($mcu_model['mcu_date'])) : '-';
        $mcu_code = !empty($mcu_model['mcu_code']) ? $mcu_model['mcu_code'] : '-';
        $mcu_package_name = 'Paket Lengkap';
        $data_anamnesis = self::getDataAnamnesis($mcu_id);
        $laboratory_examintaions = !empty($this->examination_package['laboratory_examinations']) ? $this->examination_package['laboratory_examinations'] : [];
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
        $mcu_id = $request->get('mcu_id');
        $mcu_model = McuT::find($mcu_id);
        $employee_model = EmployeeM::select('*')->where('employee_id', $mcu_model->employee_id)->first();
        $anamnesis = self::getDataPrintAnamnesis($mcu_id);
        $data = [
            'nik' => $employee_model->nik,
            'employee_name' => $employee_model->employee_name,
            'mcu_date' => date('Y/m/d', strtotime($mcu_model->mcu_date)),
            'mcu_code' => $mcu_model->mcu_code,
            'anamnesis' => $anamnesis
        ];

        $pdf = PDF::loadView('mcu.pemeriksaan.print.cetak_pemeriksaan', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('itsolutionstuff.pdf');
    }
}
