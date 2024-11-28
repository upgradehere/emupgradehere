<?php

namespace App\Http\Controllers\Mcu;

use App\Helpers\ConstantsHelper;
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
use App\Traits\LaboratoriumTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class PemeriksaanMcuController extends Controller
{
    use AnamnesisTrait;
    use LaboratoriumTrait;

    public function index(Request $request)
    {
        $mcu_id = $request->get('mcu_id');
        $employee_id = $request->get('employee_id');

        $employee_data= EmployeeM::leftJoin('lookup_c', 'lookup_c.lookup_id', '=', 'employee_m.sex')
            ->where('employee_id', $employee_id)
            ->select('nik', 'employee_name', 'lookup_c.lookup_name as sex')
            ->first();

        $mcu_model = McuT::select('mcu_date', 'mcu_code')->where('mcu_id', $mcu_id)->first();
        $mcu_date = !empty($mcu_date) ? $mcu_model['mcu_date'] : '-';
        $mcu_code = !empty($mcu_date) ? $mcu_model['mcu_code'] : '-';
        $data_anamnesis = self::getDataAnamnesis($mcu_id);
        $form_lab = self::getFormLab($mcu_id);
        // return $form_lab;

        return view('/mcu/pemeriksaan/index_pemeriksaan', get_defined_vars());
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
