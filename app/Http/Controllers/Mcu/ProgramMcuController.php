<?php

namespace App\Http\Controllers\Mcu;

use App\Http\Controllers\Controller;
use App\Models\CompanyM;
use App\Models\McuCompanyV;
use App\Models\McuEmployeeV;
use App\Models\McuProgramM;
use App\Models\McuT;
use Illuminate\Http\Request;

class ProgramMcuController extends Controller
{
    public function index()
    {
        return view('/mcu/program_mcu');
    }

    public function getDataMcuProgramCompany(Request $request)
    {
        try {
            $model = new McuCompanyV();
            $query = $model->select();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('mcu_program_name', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('company_name', 'ilike', '%' . $searchValue . '%');
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

    public function detailProgramMcu(Request $request)
    {
        $company_id = $request->get('company_id');
        $mcu_program_id = $request->get('mcu_program_id');

        $company_name = CompanyM::where('company_id', $company_id)->value('company_name');
        $mcu_program_name = McuProgramM::where('mcu_program_id', $mcu_program_id)->value('mcu_program_name');
        $mcu_sum = McuT::where('company_id', $company_id)
            ->where('mcu_program_id', $mcu_program_id)
            ->count();

        return view('/mcu/detail_program_mcu', get_defined_vars());
    }

    public function getDataMcuEmployee(Request $request)
    {
        try {
            $company_id = $request->get('company_id');
            $mcu_program_id = $request->get('mcu_program_id');
            $model = new McuEmployeeV();
            $query = $model->select();
            $query = $query->where('company_id', $company_id)->where('mcu_program_id', $mcu_program_id);

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query = $query->where(function ($q) use ($searchValue) {
                    $q->where('employee_name', 'ilike', '%' . $searchValue . '%')
                        ->orWhere('departement_name', 'ilike', '%' . $searchValue . '%');
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
}
