<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\McuProgramM;
use App\Models\McuT;
use DB;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $id_company = null;
        
        if ($user->id_role == 2) {
            $id_company = $user->id_company;
        }

        if ($id_company == null) {
            $programs = McuProgramM::all();
        } else {
            $programs = McuProgramM::where("company_id", $id_company)
                                        ->get();
        }

        $data = [
            'programs' => $programs,
        ];

        return view('/dashboard/dashboard', $data);
    }

    public function getGender($program_id)
    {
        $mcu = McuT::where("mcu_program_id", $program_id)
                    ->with("employee")
                    ->get();

        $male = 0;
        $female = 0;
        $total = 0;

        foreach($mcu as $m) {
            if ($m->employee->sex == 11) {
                $male += 1;
            } else {
                $female += 1;
            }
        }

        $total = count($mcu);

        $data = [
            'status' => 'success',
            'data' => [
                'male' => $male,
                'female' => $female,
                'total' => $total,
            ]
        ];

        return response()->json($data, 200);
    }

    public function getParticipant($id_program)
    {
        $query = "
            SELECT 
                departement_name,
                sex,
                COUNT(*) AS count
            FROM 
                mcu_employee_v 
            WHERE 
                mcu_program_id = ?
            GROUP BY 
                departement_name, sex
            ORDER BY 
                count DESC
            LIMIT 10
        ";

        $results = DB::select($query, [$id_program]);

        $data = [];

        foreach ($results as $row) {
            $index = array_search($row->departement_name, array_column($data, 'name'));

            if ($index === false) {
                $data[] = [
                    'name' => $row->departement_name,
                    'male' => ($row->sex == 'Laki-laki') ? $row->count : 0,
                    'female' => ($row->sex == 'Perempuan') ? $row->count : 0,
                ];
            } else {
                if ($row->sex == 'Laki-laki') {
                    $data[$index]['male'] += $row->count;
                } elseif ($row->sex == 'Perempuan') {
                    $data[$index]['female'] += $row->count;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getAge($id_program)
    {
         $query = "
            SELECT
                CASE
                    WHEN EXTRACT(YEAR FROM AGE(dob)) < 25 THEN '<25'
                    WHEN EXTRACT(YEAR FROM AGE(dob)) BETWEEN 26 AND 35 THEN '26-35'
                    WHEN EXTRACT(YEAR FROM AGE(dob)) BETWEEN 36 AND 45 THEN '36-45'
                    WHEN EXTRACT(YEAR FROM AGE(dob)) BETWEEN 46 AND 55 THEN '46-55'
                    ELSE '>55'
                END AS age_range,
                sex,
                COUNT(*) AS count
            FROM mcu_employee_v
            WHERE mcu_program_id = ?
            GROUP BY age_range, sex
            ORDER BY sex
        ";

        $results = DB::select($query, [$id_program]);

        $data = [
            ['name' => '<25', 'male' => 0, 'female' => 0],
            ['name' => '26-35', 'male' => 0, 'female' => 0],
            ['name' => '36-45', 'male' => 0, 'female' => 0],
            ['name' => '46-55', 'male' => 0, 'female' => 0],
            ['name' => '>55', 'male' => 0, 'female' => 0]
        ];

        foreach ($results as $result) {
            $index = array_search($result->age_range, array_column($data, 'name'));

            if ($index !== false) {
                if ($result->sex == 'Laki-laki') {
                    $data[$index]['male'] += $result->count;
                } elseif ($result->sex == 'Perempuan') {
                    $data[$index]['female'] += $result->count;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getHealthCategory($id_program)
    {
        $data = [
            ['value' => 1048, 'name' => 'Fit with Note'],
            ['value' => 735, 'name' => 'Fit to Work'],
            ['value' => 580, 'name' => 'Temporary Unfit'],
            ['value' => 484, 'name' => 'nan']
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getMetabolicSyndrome($id_program)
    {
        $data = [
            'normal' => 70,   // Number of participants with normal condition
            'abnormal' => 30  // Number of participants with abnormal condition
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getDiseaseHistory($id_program)
    {
        $data = [
            ['name' => 'Diabetes Mellitus', 'diagnosis_count' => 150],
            ['name' => 'Hypertension', 'diagnosis_count' => 200],
            ['name' => 'Heart Disease', 'diagnosis_count' => 120],
            ['name' => 'Gastritis', 'diagnosis_count' => 90],
            ['name' => 'Asthma', 'diagnosis_count' => 85],
            ['name' => 'Pneumonia', 'diagnosis_count' => 75],
            ['name' => 'Stroke', 'diagnosis_count' => 110],
            ['name' => 'Lung Cancer', 'diagnosis_count' => 50],
            ['name' => 'Kidney Disease', 'diagnosis_count' => 60],
            ['name' => 'Respiratory Tract Infection', 'diagnosis_count' => 140]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getLabDiagnosis($id_program)
    {
        $query_male = "
            SELECT
                laboratory_detail_t.laboratory_examination_id,
                laboratory_examination_m.laboratory_examination_name,
                COUNT(laboratory_detail_t.laboratory_examination_id) AS count,
                mcu_t.mcu_program_id,
                e_m.sex
            FROM laboratory_detail_t
            LEFT JOIN laboratory_examination_m
                ON laboratory_examination_m.laboratory_examination_id = laboratory_detail_t.laboratory_examination_id
            LEFT JOIN laboratory_t
                ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
            LEFT JOIN mcu_t
                ON mcu_t.mcu_id = laboratory_t.mcu_id
            LEFT JOIN employee_m e_m
                ON mcu_t.employee_id = e_m.employee_id
            WHERE laboratory_detail_t.is_abnormal IS TRUE
                AND e_m.sex = 11  -- Male
                AND mcu_t.mcu_program_id = ?
            GROUP BY laboratory_detail_t.laboratory_examination_id, laboratory_examination_m.laboratory_examination_name, mcu_t.mcu_program_id, e_m.sex
            ORDER BY count DESC
            LIMIT 10
        ";

        $results_male = DB::select($query_male, [$id_program]);

        $query_female = "
            SELECT
                laboratory_detail_t.laboratory_examination_id,
                laboratory_examination_m.laboratory_examination_name,
                COUNT(laboratory_detail_t.laboratory_examination_id) AS count,
                mcu_t.mcu_program_id,
                e_m.sex
            FROM laboratory_detail_t
            LEFT JOIN laboratory_examination_m
                ON laboratory_examination_m.laboratory_examination_id = laboratory_detail_t.laboratory_examination_id
            LEFT JOIN laboratory_t
                ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
            LEFT JOIN mcu_t
                ON mcu_t.mcu_id = laboratory_t.mcu_id
            LEFT JOIN employee_m e_m
                ON mcu_t.employee_id = e_m.employee_id
            WHERE laboratory_detail_t.is_abnormal IS TRUE
                AND e_m.sex = 12  -- Female
                AND mcu_t.mcu_program_id = ?
            GROUP BY laboratory_detail_t.laboratory_examination_id, laboratory_examination_m.laboratory_examination_name, mcu_t.mcu_program_id, e_m.sex
            ORDER BY count DESC
            LIMIT 10
        ";

        $results_female = DB::select($query_female, [$id_program]);

        $data = [];

        foreach ($results_male as $row_male) {
            $index = array_search($row_male->laboratory_examination_name, array_column($data, 'name'));

            if ($index === false) {
                $data[] = [
                    'name' => $row_male->laboratory_examination_name,
                    'male' => $row_male->count,
                    'female' => 0 
                ];
            } else {
                $data[$index]['male'] += $row_male->count;
            }
        }

        foreach ($results_female as $row_female) {
            $index = array_search($row_female->laboratory_examination_name, array_column($data, 'name'));

            if ($index === false) {
                $data[] = [
                    'name' => $row_female->laboratory_examination_name,
                    'male' => 0,
                    'female' => $row_female->count
                ];
            } else {
                $data[$index]['female'] += $row_female->count;
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getNonLabDiagnosis($id_program)
    {
        $data = [
            ['name' => 'Cardiovascular Function Test', 'abnormal' => 150],
            ['name' => 'Metabolic Liver Function Test', 'abnormal' => 50],
            ['name' => 'Complex Lipid Profile Test', 'abnormal' => 90],
            ['name' => 'Fasting Blood Sugar Test', 'abnormal' => 120],
            ['name' => 'Dynamic Kidney Function Test', 'abnormal' => 70],
            ['name' => 'Hepatitis B & C Test', 'abnormal' => 30],
            ['name' => 'Complete Urinalysis Test', 'abnormal' => 110],
            ['name' => 'Oncology: Genetic Cancer Test', 'abnormal' => 40],
            ['name' => 'HIV and Immunology Test', 'abnormal' => 15],
            ['name' => 'TB Screening Test', 'abnormal' => 20]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getSymptoms($id_program)
    {
        $data = [
            [
                'disease' => 'Diabetes',
                'diagnoses' => [
                    'Initial Diagnosis' => 320,
                    'Follow-up Examination' => 120,
                    'Treatment Recommendations' => 220
                ]
            ],
            [
                'disease' => 'Hypertension',
                'diagnoses' => [
                    'Initial Diagnosis' => 302,
                    'Follow-up Examination' => 132,
                    'Treatment Recommendations' => 182,
                    'Follow-up Actions' => 212
                ]
            ],
            [
                'disease' => 'Asthma',
                'diagnoses' => [
                    'Initial Diagnosis' => 301,
                    'Follow-up Examination' => 101
                ]
            ],
            [
                'disease' => 'Heart Disease',
                'diagnoses' => [
                    'Initial Diagnosis' => 334,
                    'Follow-up Examination' => 134,
                    'Treatment Recommendations' => 234,
                    'Follow-up Actions' => 154,
                    'Diet Recommendations' => 934
                ]
            ],
            [
                'disease' => 'Cancer',
                'diagnoses' => [
                    'Initial Diagnosis' => 390,
                    'Follow-up Examination' => 90,
                    'Treatment Recommendations' => 290
                ]
            ],
            [
                'disease' => 'Stroke',
                'diagnoses' => [
                    'Initial Diagnosis' => 330,
                    'Follow-up Examination' => 230,
                    'Treatment Recommendations' => 330,
                    'Follow-up Actions' => 330
                ]
            ],
            [
                'disease' => 'Kidney Disease',
                'diagnoses' => [
                    'Initial Diagnosis' => 320,
                    'Follow-up Examination' => 210,
                    'Treatment Recommendations' => 310,
                    'Follow-up Actions' => 410,
                    'Diet Recommendations' => 1320
                ]
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getConclusionAndRecommendation($id_program)
    {
        $programs = McuProgramM::where("mcu_program_id", $id_program)
                                        ->first();
        $data = [
            'conclusion' => $programs->conclusions,
            'recommendation' => $programs->suggestions
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

}
