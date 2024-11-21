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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanMcuController extends Controller
{
    public function index(Request $request)
    {
        $mcu_id = $request->get('mcu_id');
        $employee_id = $request->get('employee_id');

        $employee_data= EmployeeM::leftJoin('lookup_c', 'lookup_c.lookup_id', '=', 'employee_m.sex')
            ->where('employee_id', $employee_id)
            ->select('nik', 'employee_name', 'lookup_c.lookup_name as sex')
            ->first();

        $mcu_date = McuT::select('mcu_date')->where('mcu_id', $mcu_id)->first();
        $mcu_date = !empty($mcu_date) ? $mcu_date['mcu_date'] : '-';

        return view('/mcu/pemeriksaan/index_pemeriksaan', get_defined_vars());
    }
}
