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
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

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

        $employee_sum = McuT::where('company_id', 1)
            ->where('mcu_program_id', 4)
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
            $query = $query->where('company_id', $company_id)->where('mcu_program_id', $mcu_program_id);
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
            unset($post['mcu_code']);
            DB::beginTransaction();
            $model = new McuT();
            $model->create($post);
            DB::commit();

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
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_LAB:
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RONTGEN:
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_AUDIOMETRY:
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_SPIROMETRY:
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_EKG:
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_USG:
                case ConstantsHelper::LOOKUP_EXAMINATION_TYPE_TREADMILL:
                    return redirect()->back()->with('error', 'Belum Tersedia!');
                default:
                    return redirect()->back()->with('error', 'Jenis Pemeriksaan Salah!');
            }

            if ($import_model == null) {
                throw new \Exception('Terjadi Kesalahan!');
            }

            Excel::import($import_model, $request->file('import_file'));
            return redirect()->back()->with('success', 'Imported Successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
