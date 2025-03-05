<?php

namespace App\Http\Controllers\Mcu;

use App\Helpers\ConstantsHelper;
use App\Helpers\GlobalHelper;
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
            $employee_id = NULL;

            if ($auth->id_role == 2 || $auth->id_role == 5) {
                $company_id = $auth->id_company;
                if ($auth->id_role == 5) {
                    $employee_id = $auth->id_employee;
                }
            } else {
                if ($company_id == 'A') {
                    $company_id = NULL;
                }
            }

            $model = new McuCompanyV();
            $query = $model->select();

            if ($company_id !== NULL) {
                $query->where('company_id', $company_id);
            }
            $resp = GlobalHelper::dataTable($request, $query);
            
            if ($auth->id_role == 5) {
                foreach($resp['data'] as $k => $r) {
                    $mcu_program_id = $r['mcu_program_id'];
                    
                    $check = McuT::where('mcu_program_id', $mcu_program_id)
                                    ->where('employee_id', $employee_id)
                                    ->first();
                    if (!$check) {
                        unset($resp['data'][$k]);
                    }
                }
            }

            return response()->json($resp);
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
        $chart_type = $request->get('chart_type');
        $chart_value = $request->get('chart_value');
        $chart_additional = $request->get('chart_additional');
        $employees = EmployeeM::select('employee_id', 'employee_code', 'employee_name')->where('company_id', $company_id)->get();
        $packages = PackageM::select('id', 'package_code', 'package_name')->get();

        // $mcu_program_name = McuProgramM::where('mcu_program_id', $mcu_program_id)->value('mcu_program_name');
        $mcu_program_name = McuProgramM::where('mcu_program_id', $mcu_program_id)->first();
        if (!empty($chart_type)) {
            $company_id = $mcu_program_name->company_id;
        }
        $company_name = CompanyM::where('company_id', $company_id)->value('company_name');
        $mcu_sum = McuEmployeeV::where('company_id', $company_id)
            ->where('mcu_program_id', $mcu_program_id);

        $employee_sum = McuEmployeeV::where('company_id', $company_id)
            ->where('mcu_program_id', $mcu_program_id);

        if (!empty($chart_type)) {
            $mcu_sum = self::getDataFromChart($mcu_sum, $chart_type, $chart_value, $chart_additional, $mcu_program_id, null);
            $employee_sum = self::getDataFromChart($employee_sum, $chart_type, $chart_value, $chart_additional, $mcu_program_id, null);
        }
        $mcu_sum = $mcu_sum->count();
        $employee_sum = $employee_sum->distinct('mcu_employee_v.employee_id')
        ->count('mcu_employee_v.employee_id');

        $examination_type = LookupC::select('lookup_id as examination_type_id', 'lookup_name as examination_type_name')->where('lookup_type', ConstantsHelper::LOOKUP_EXAMINATION_TYPE)->get();

        return view('/mcu/detail_program_mcu', get_defined_vars());
    }

    public function getDataMcuEmployee(Request $request)
    {
        try {
            $company_id = $request->get('company_id');
            $mcu_program_id = $request->get('mcu_program_id');
            $chart_type = $request->get('chart_type');
            $chart_value = $request->get('chart_value');
            $chart_additional = $request->get('chart_additional');
            $model = new McuEmployeeV();
            $query = $model->select(
                'mcu_employee_v.mcu_id',
                'mcu_employee_v.mcu_code',
                'mcu_employee_v.mcu_date',
                'mcu_employee_v.employee_id',
                'mcu_employee_v.employee_code',
                'mcu_employee_v.employee_name',
                'mcu_employee_v.departement_id',
                'mcu_employee_v.departement_code',
                'mcu_employee_v.departement_name',
                'mcu_employee_v.company_id',
                'mcu_employee_v.mcu_program_id',
                'mcu_employee_v.sex',
                'mcu_employee_v.sex_id',
                'mcu_employee_v.dob',
                'mcu_employee_v.age',
                'mcu_employee_v.age_number',
                'mcu_employee_v.additional_data',
                'mcu_employee_v.nik',
                'mcu_employee_v.package_id',
                'mcu_employee_v.package_code',
                'mcu_employee_v.package_name',
                'mcu_employee_v.deleted_at',
                'mcu_employee_v.is_import'
            );
            $query = $query->where('mcu_program_id', $mcu_program_id)->where('mcu_employee_v.deleted_at', null);

            $auth = Auth::user();

            if ($auth->id_role == 5) {
                $query = $query->where('employee_id', $auth->id_employee);
            }

            if (empty($chart_type)) {
                $query = $query->where('company_id', $company_id);
            } else {
                $query = self::getDataFromChart($query, $chart_type, $chart_value, $chart_additional, $mcu_program_id, null);
            }

            return response()->json(GlobalHelper::dataTable($request, $query));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    private function getDataFromChart($query, $chart_type, $chart_value, $chart_additional, $mcu_program_id, $additional = null) {
        $sex = ($additional == 'sex') ? 'sex' : 'sex_id';
        switch ($chart_type) {
            case 'chart_male':
                $query = $query->where($sex, ConstantsHelper::LOOKUP_SEX_MALE);
                break;

            case 'chart_male_total':
            case 'chart_female_total':
                $query = $query->where(function($query) use ($sex) {
                    $query->where($sex, ConstantsHelper::LOOKUP_SEX_MALE)
                          ->orWhere($sex, ConstantsHelper::LOOKUP_SEX_FEMALE);
                });
                break;

            case 'chart_female':
                $query = $query->where($sex, ConstantsHelper::LOOKUP_SEX_FEMALE);
                break;
            case 'chart_peserta':
                $query = $query->where('departement_name', $chart_value);
                break;
            case 'chart_usia':
                switch ($chart_value) {
                    //<25
                    case '1_pria':
                        $query = $query->where('age_number', '<', 25);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_MALE);
                        break;
                    case '1_wanita':
                        $query = $query->where('age_number', '<', 25);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_FEMALE);
                        break;
                    //26-35
                    case '2_pria':
                        $query = $query->whereBetween('age_number', [26, 35]);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_MALE);
                        break;
                    case '2_wanita':
                        $query = $query->whereBetween('age_number', [26, 35]);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_FEMALE);
                    //36-45
                    case '3_pria':
                        $query = $query->whereBetween('age_number', [36, 45]);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_MALE);
                        break;
                    case '3_wanita':
                        $query = $query->whereBetween('age_number', [36, 45]);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_FEMALE);
                        break;
                    //46-55
                    case '4_pria':
                        $query = $query->whereBetween('age_number', [46, 55]);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_MALE);
                        break;
                    case '4_wanita':
                        $query = $query->whereBetween('age_number', [46, 55]);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_FEMALE);
                        break;
                    //>55
                    case '5_pria':
                        $query = $query->where('age_number', '>', 55);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_MALE);
                        break;
                    case '5_wanita':
                        $query = $query->where('age_number', '>', 55);
                        $query = $query->where('sex_id', ConstantsHelper::LOOKUP_SEX_FEMALE);
                        break;
                    default:
                    break;
                }
                break;
            case 'chart_riwayat_penyakit':
                switch ($chart_value) {
                    case 'Bmi':
                        $query = $query->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('anamnesis_t.deleted_at', null);
                        $query = $query->whereNotNull('bmi');
                        break;
                    case 'Gigi':
                        $query = $query->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('anamnesis_t.deleted_at', null);
                        $query = $query->where(function ($query) {
                            $query->whereRaw("anamnesis_t.teeth::json->>'carries_dentis' = '1'")
                                  ->orWhereRaw("anamnesis_t.teeth::json->>'gangren_radix' = '1'")
                                  ->orWhereRaw("anamnesis_t.teeth::json->>'gangren_pulpa' = '1'")
                                  ->orWhereRaw("anamnesis_t.teeth::json->>'calculus_dentis' = '1'")
                                  ->orWhereRaw("anamnesis_t.teeth::json->>'dentures' = '1'");
                        });
                        break;
                    case 'Visus Mata':
                        $query = $query->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('anamnesis_t.deleted_at', null);
                        $query = $query->where(function ($query) {
                            $query->whereRaw("anamnesis_t.eyes::json->>'color_blind' = '1'")
                                  ->orWhereRaw("anamnesis_t.eyes::json->>'visus' = '1'")
                                  ->orWhereRaw("anamnesis_t.eyes::json->>'strabismus' = '1'")
                                  ->orWhereRaw("anamnesis_t.eyes::json->>'anemic_conjunctiva' = '1'")
                                  ->orWhereRaw("anamnesis_t.eyes::json->>'icteric_sclera' = '1'")
                                  ->orWhereRaw("anamnesis_t.eyes::json->>'pupillary_reflex' = '0'")
                                  ->orWhereRaw("anamnesis_t.eyes::json->>'eye_gland_disorders' = '1'");
                        });
                        break;
                    case 'Tekanan Darah':
                        $query = $query->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('anamnesis_t.deleted_at', null);
                        $query = $query->where(function ($query) {
                            $query->where('systolic', '>', 139)
                                  ->where('diastolic', '>', 89);
                        })->orWhere(function ($query) {
                            $query->where('systolic', '<', 90)
                                  ->where('diastolic', '<', 60);
                        });
                        break;
                    case 'Rontgen':
                        $query = $query->leftJoin('rontgen_t', 'rontgen_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('rontgen_t.is_abnormal', 1);
                        $query = $query->where('rontgen_t.deleted_at', null);
                        break;
                    case 'Usg':
                        $query = $query->leftJoin('usg_t', 'usg_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('usg_t.is_abnormal', 1);
                        $query = $query->where('usg_t.deleted_at', null);
                        break;
                    case 'Treadmill':
                        $query = $query->leftJoin('treadmill_t', 'treadmill_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('treadmill_t.is_abnormal', 1);
                        $query = $query->where('treadmill_t.deleted_at', null);
                        break;
                    case 'Papsmear':
                        $query = $query->leftJoin('papsmear_t', 'papsmear_t.mcu_id', 'mcu_employee_v.mcu_id');
                        $query = $query->where('papsmear_t.is_abnormal', 1);
                        $query = $query->where('papsmear_t.deleted_at', null);
                        break;
                    default:
                    break;
                }
                break;
            case 'chart_kategori_kesehatan':
                $query = $query->leftJoin('resume_mcu_t', 'resume_mcu_t.mcu_id', 'mcu_employee_v.mcu_id');
                $query = $query->leftJoin('lookup_c', 'lookup_c.lookup_id', '=', DB::raw('CAST(resume_mcu_t.result_conclusion AS INTEGER)'));
                switch ($chart_value) {
                    case ConstantsHelper::KESIMPULAN_FIT_TO_WORK_NAME:
                        $query = $query->where('resume_mcu_t.result_conclusion', ConstantsHelper::KESIMPULAN_FIT_TO_WORK);
                        break;
                    case ConstantsHelper::KESIMPULAN_FIT_TO_WORK_WITH_MEDICAL_NOTE_NAME:
                        $query = $query->where('resume_mcu_t.result_conclusion', ConstantsHelper::KESIMPULAN_FIT_TO_WORK_WITH_MEDICAL_NOTE);
                        break;
                    case ConstantsHelper::KESIMPULAN_FIT_TEMPORARY_UNFIT_NAME:
                        $query = $query->where('resume_mcu_t.result_conclusion', ConstantsHelper::KESIMPULAN_FIT_TEMPORARY_UNFIT);
                        break;
                    case ConstantsHelper::KESIMPULAN_NEED_FURTHER_EXAMINATION_NAME:
                        $query = $query->where('resume_mcu_t.result_conclusion', ConstantsHelper::KESIMPULAN_NEED_FURTHER_EXAMINATION);
                        break;
                    case ConstantsHelper::KESIMPULAN_FIT_WITH_NOTE_NAME:
                        $query = $query->where('resume_mcu_t.result_conclusion', ConstantsHelper::KESIMPULAN_FIT_WITH_NOTE);
                        break;
                    default:
                    break;
                }
                $query = $query->where('resume_mcu_t.deleted_at', null);
                break;
            case 'chart_riwayat_diagnosa_non_lab':
                $query = $query->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', 'mcu_employee_v.mcu_id');
                switch($chart_value){
                    case 'surgical_history':
                        $query = $query->whereRaw("medical_history::json->>'surgical_history' = ?", ['1']);
                        break;
                    case 'hypotension':
                        $query = $query->whereRaw("medical_history::json->>'hypotension' = ?", ['1']);
                        break;
                    case 'allergy':
                        $query = $query->whereRaw("medical_history::json->>'allergy' = ?", ['1']);
                        break;
                    case 'hypertension':
                        $query = $query->whereRaw("medical_history::json->>'hypertension' = ?", ['1']);
                        break;
                    case 'haemoptysis':
                        $query = $query->whereRaw("medical_history::json->>'haemoptysis' = ?", ['1']);
                        break;
                    case 'rheumatism':
                        $query = $query->whereRaw("medical_history::json->>'rheumatism' = ?", ['1']);
                        break;
                    case 'fracture':
                        $query = $query->whereRaw("medical_history::json->>'fracture' = ?", ['1']);
                        break;
                    case 'asthma':
                        $query = $query->whereRaw("medical_history::json->>'asthma' = ?", ['1']);
                        break;
                    default:
                    break;
                }
                $query = $query->where('anamnesis_t.deleted_at', null);
                break;
            case 'chart_riwayat_diagnosa_lab':
                $query = $query->leftJoin('laboratory_t', 'laboratory_t.mcu_id', 'mcu_employee_v.mcu_id');
                $query = $query->leftJoin('laboratory_detail_t', 'laboratory_detail_t.laboratory_id', 'laboratory_t.laboratory_id');
                $query = $query->where('laboratory_detail_t.laboratory_examination_id', $chart_value);
                $query = $query->where('laboratory_detail_t.is_abnormal', true);
                $query = $query->where('laboratory_t.deleted_at', null);
                $query = $query->where('laboratory_detail_t.deleted_at', null);
                break;
            case 'chart_kategori_sindrom_metabolik':
                $query = $query->leftJoinSub(
                    DB::table(DB::raw("fn_metabolik_normal_abnormal_all_data($mcu_program_id)")),
                    'a',
                    'a.mcu_id',
                    '=',
                    'mcu_employee_v.mcu_id'
                );
                if ($chart_value == 'Normal') {
                    $query = $query->where('total_abnormal_examinations', '<', 3);
                } else if ($chart_value == 'Abnormal') {
                    $query = $query->where('total_abnormal_examinations', '>=', 3);
                }
                break;
            case 'chart_gejala':
                switch ($chart_value) {
                    case 'Tekanan Darah':
                        $query = $query->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', 'mcu_employee_v.mcu_id');
                        if ($chart_additional == 'Normal') {
                            $query = $query
                            ->where('systolic', '<', 120)
                            ->where('diastolic', '<', 80);
                        } else if ($chart_additional == 'Elevasi') {
                            $query = $query
                            ->whereBetween('systolic', [119, 129])
                            ->where('diastolic', '<', 80);
                        } else if ($chart_additional == 'Hipertensi Derajat 1') {
                            $query = $query
                            ->where(function ($query) {
                                $query->whereBetween('systolic', [130, 139])
                                      ->orWhereBetween('diastolic', [80, 89]);
                            });
                        } else if ($chart_additional == 'Hipertensi Derajat 2') {
                            $query = $query
                            ->where(function ($query) {
                                $query->whereBetween('systolic', [140, 179])
                                      ->orWhereBetween('diastolic', [90, 119]);
                            });
                        } else if ($chart_additional == 'Krisis Hipertensi') {
                            $query = $query
                            ->where(function ($query) {
                                $query->where('systolic', '>=', 180)
                                      ->orWhere('diastolic', '>=', 120);
                            });
                        }
                        $query = $query->where('anamnesis_t.deleted_at', null);
                        break;
                    case 'Bmi':
                        $query = $query->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', 'mcu_employee_v.mcu_id');
                        if ($chart_additional == 'Berat Badan Kurang') {
                            $query = $query->where('bmi', '<', 18.5);
                        } else if ($chart_additional == 'Normal') {
                            $query = $query->whereBetween('bmi', [18.5, 22.9]);
                        } else if ($chart_additional == 'Overweight') {
                            $query = $query->whereBetween('bmi', [23, 24.9]);
                        } else if ($chart_additional == 'Obesitas Tingkat 1') {
                            $query = $query->whereBetween('bmi', [25, 29.9]);
                        } else if ($chart_additional == 'Obesitas Tingkat 2') {
                            $query = $query->where('bmi', '>=', 30);
                        }
                        $query = $query->where('anamnesis_t.deleted_at', null);
                        break;
                    case 'Asam Urat':
                        $query = $query->leftJoin('laboratory_t', 'laboratory_t.mcu_id', 'mcu_employee_v.mcu_id')
                        ->leftJoin('laboratory_detail_t', 'laboratory_detail_t.laboratory_id', 'laboratory_t.laboratory_id')
                        ->where('laboratory_detail_t.laboratory_examination_id', 56);
                        if ($chart_additional == 'Tinggi') {
                            $query = $query->where(function ($query) {
                                $query->where(function ($subQuery) {
                                    $subQuery->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '>', 7.0)
                                             ->where('mcu_employee_v.sex_id', '=', 11);
                                })
                                ->orWhere(function ($subQuery) {
                                    $subQuery->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '>', 6.0)
                                             ->where('mcu_employee_v.sex_id', '=', 12);
                                });
                            });
                        } else if ($chart_additional == 'Normal') {
                            $query = $query->where(function ($query) {
                                $query->where(function ($subQuery) {
                                    $subQuery->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '<=', 7.0)
                                             ->where('mcu_employee_v.sex_id', '=', 11);
                                })
                                ->orWhere(function ($subQuery) {
                                    $subQuery->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '<=', 6.0)
                                             ->where('mcu_employee_v.sex_id', '=', 12);
                                });
                            });
                        }
                        $query = $query->where('laboratory_t.deleted_at', null)->where('laboratory_detail_t.deleted_at', null);
                        break;
                    case 'Kolesterol':
                        $query = $query->leftJoin('laboratory_t', 'laboratory_t.mcu_id', 'mcu_employee_v.mcu_id')
                        ->leftJoin('laboratory_detail_t', 'laboratory_detail_t.laboratory_id', 'laboratory_t.laboratory_id')->where('laboratory_detail_t.laboratory_examination_id', 46);
                        if ($chart_additional == 'Normal') {
                            $query = $query->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '<=', 199);
                        } else if ($chart_additional == 'Batas Tinggi') {
                            $query = $query->whereBetween(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), [200, 239]);
                        } else if ($chart_additional == 'Tinggi') {
                            $query = $query->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '>=', 240);
                        }
                        $query = $query->where('laboratory_t.deleted_at', null)->where('laboratory_detail_t.deleted_at', null);
                        break;
                    case 'Glukosa Sewaktu':
                        $query = $query->leftJoin('laboratory_t', 'laboratory_t.mcu_id', 'mcu_employee_v.mcu_id')
                        ->leftJoin('laboratory_detail_t', 'laboratory_detail_t.laboratory_id', 'laboratory_t.laboratory_id')->where('laboratory_detail_t.laboratory_examination_id', 50);
                        if ($chart_additional == 'Normal') {
                            $query = $query->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '<', 140);
                        } else if ($chart_additional == 'Prediabetes') {
                            $query = $query->whereBetween(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), [140, 199]);
                        } else if ($chart_additional == 'Diabetes') {
                            $query = $query->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '>=', 200);
                        }
                        $query = $query->where('laboratory_t.deleted_at', null)->where('laboratory_detail_t.deleted_at', null);
                        break;
                    case 'Glukosa Puasa':
                        $query = $query->leftJoin('laboratory_t', 'laboratory_t.mcu_id', 'mcu_employee_v.mcu_id')
                        ->leftJoin('laboratory_detail_t', 'laboratory_detail_t.laboratory_id', 'laboratory_t.laboratory_id')->where('laboratory_detail_t.laboratory_examination_id', 51);
                        if ($chart_additional == 'Normal') {
                            $query = $query->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '<', 100);
                        } else if ($chart_additional == 'Prediabetes') {
                            $query = $query->whereBetween(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), [100, 125]);
                        } else if ($chart_additional == 'Diabetes') {
                            $query = $query->where(DB::raw('CAST(laboratory_detail_t.result AS NUMERIC)'), '>=', 126);
                        }
                        $query = $query->where('laboratory_t.deleted_at', null)->where('laboratory_detail_t.deleted_at', null);
                        break;
                    case 'Rontgen':
                        $query = $query->leftJoin('rontgen_t', 'rontgen_t.mcu_id', 'mcu_employee_v.mcu_id');
                        if ($chart_additional == 'Normal') {
                            $query = $query->where('rontgen_t.is_abnormal', false);
                        } else if ($chart_additional == 'Abnormal') {
                            $query = $query->where('rontgen_t.is_abnormal', true);
                        }
                        $query = $query->where('rontgen_t.deleted_at', null);
                        break;
                    default:
                    break;
                }
                break;
            default:
            break;
        }
        return $query;
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
                    $imagePath = 'uploads/spirometry/';
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
                    $extractPath = 'uploads/treadmill/extract/';
                    $imagePath = 'uploads/treadmill/';
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
                Storage::delete($zipPath);
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
                $pattern = '/^\d+_\d+_[A-Za-z0-9]+_' . preg_quote($category, '/') . '$/i';
                if (in_array(strtolower($extension), $allowedExtensions) && is_file($filePath) && preg_match($pattern, $fileName)) {

                    $filename = $fileName . '.' . $extension;
                    $storedPath = $imagePath . $filename;

                    $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);  // Get the filename without extension
                    $order = explode('_', $fileNameWithoutExtension)[0];
                    $nik = explode('_', $fileNameWithoutExtension)[1];
                    $packageCode = explode('_', $fileNameWithoutExtension)[2];

                    $employeeModel = EmployeeM::select('employee_id')->where('nik', $nik)->first();
                    $packageModel = PackageM::select('id')->where('package_code', $packageCode)->first();

                    if ($employeeModel == null) {
                        Storage::delete($zipPath);
                        throw new \Exception('Terjadi Kesalahan! Peserta dengan nik '.$nik.' Tidak Ditemukan!');
                    }
                    if ($packageModel == null) {
                        Storage::delete($zipPath);
                        throw new \Exception('Terjadi Kesalahan! Kode paket '.$packageCode.' Tidak Ditemukan!');
                    }

                    if (!is_dir($imagePath)) {
                        mkdir($imagePath, 0755, true);
                    }
                    $filename = $order . '_' . $category . '_' . Str::uuid() . '.' . $extension;
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

                    $payload = [
                        'mcu_id' => $mcu_id
                    ];
                    $existingRecord = $model->where('mcu_id', $mcu_id)->first();
                    if ($existingRecord) {
                        $existingImages = !empty($existingRecord->image_file) ? json_decode($existingRecord->image_file) : [];
                        array_push($existingImages, $filename);
                        $payload['image_file'] = json_encode($existingImages);
                        $existingRecord->update($payload);
                    } else {
                        $images = [];
                        $images[] = $filename;
                        $payload['image_file'] = json_encode($images);
                        $payload['is_import'] = true;
                        $model->insert($payload);
                    }
                } else {
                    Storage::delete($zipPath);
                    throw new \Exception('Nama file tidak sesuai!');
                }
            }
            Storage::delete($zipPath);
            return redirect()->back()->with('success', 'Upload Hasil Sukses');
        } catch (ValidationException $e) {
            Log::info($e);
            if (is_dir($extractPath)) {
                File::deleteDirectory($extractPath);
            }
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            Log::info($e);
            if (is_dir($extractPath)) {
                File::deleteDirectory($extractPath);
            }
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

    public function deleteProgram($id)
    {
        $program = McuProgramM::find($id);

        if ($program->delete()) {
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
}
