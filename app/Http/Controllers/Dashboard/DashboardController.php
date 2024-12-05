<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\McuProgramM;
use App\Models\McuT;

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
        $data = [
            ['name' => 'Heart Examination', 'male' => 120, 'female' => 150],
            ['name' => 'Eye Examination', 'male' => 132, 'female' => 182],
            ['name' => 'Vaccination', 'male' => 101, 'female' => 180],
            ['name' => 'Dental Examination', 'male' => 134, 'female' => 210],
            ['name' => 'Health Consultation', 'male' => 90, 'female' => 240],
            ['name' => 'Skin Examination', 'male' => 230, 'female' => 270],
            ['name' => 'Cholesterol Check', 'male' => 210, 'female' => 230],
            ['name' => 'Blood Examination', 'male' => 100, 'female' => 170],
            ['name' => 'Diabetes Test', 'male' => 80, 'female' => 160],
            ['name' => 'COVID-19 Test', 'male' => 110, 'female' => 200],
            ['name' => 'Lung Examination', 'male' => 95, 'female' => 220],
            ['name' => 'Blood Pressure Check', 'male' => 160, 'female' => 250],
            ['name' => 'Ear Examination', 'male' => 135, 'female' => 245],
            ['name' => 'Cholesterol Test', 'male' => 125, 'female' => 165],
            ['name' => 'Kidney Examination', 'male' => 140, 'female' => 180],
            ['name' => 'Eye Check', 'male' => 150, 'female' => 210],
            ['name' => 'ENT Examination', 'male' => 110, 'female' => 190],
            ['name' => 'Liver Function Test', 'male' => 115, 'female' => 160],
            ['name' => 'Stamina Examination', 'male' => 180, 'female' => 210],
            ['name' => 'Flu Vaccination', 'male' => 160, 'female' => 220],
            ['name' => 'Mental Health Check', 'male' => 100, 'female' => 160],
            ['name' => 'Heart Health Check', 'male' => 200, 'female' => 250],
            ['name' => 'Endocrine Examination', 'male' => 105, 'female' => 190],
            ['name' => 'Rapid COVID-19 Test', 'male' => 130, 'female' => 210],
            ['name' => 'Diet Examination', 'male' => 95, 'female' => 170],
            ['name' => 'Reproductive Health Check', 'male' => 90, 'female' => 220],
            ['name' => 'Blood Sugar Check', 'male' => 145, 'female' => 200],
            ['name' => 'Nutrition Check', 'male' => 120, 'female' => 180],
            ['name' => 'Immunization Check', 'male' => 105, 'female' => 145],
            ['name' => 'Dental Health Check', 'male' => 110, 'female' => 185]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getAge($id_program)
    {
        $data = [
            ['name' => '<25', 'male' => 40, 'female' => 60],
            ['name' => '26-35', 'male' => 70, 'female' => 90],
            ['name' => '36-45', 'male' => 50, 'female' => 80],
            ['name' => '46-55', 'male' => 30, 'female' => 50],
            ['name' => '>55', 'male' => 20, 'female' => 40]
        ];

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
        $data = [
            ['name' => 'Complete Blood Count', 'male' => 150, 'female' => 120],
            ['name' => 'Liver Function', 'male' => 80, 'female' => 70],
            ['name' => 'Cholesterol', 'male' => 110, 'female' => 90],
            ['name' => 'Blood Sugar', 'male' => 130, 'female' => 100],
            ['name' => 'Kidney Function', 'male' => 95, 'female' => 85],
            ['name' => 'Hepatitis', 'male' => 60, 'female' => 50],
            ['name' => 'Urine Test', 'male' => 140, 'female' => 110],
            ['name' => 'Cancer', 'male' => 70, 'female' => 60],
            ['name' => 'HIV', 'male' => 40, 'female' => 35],
            ['name' => 'TB (Tuberculosis)', 'male' => 55, 'female' => 45]
        ];

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
        $data = [
            'conclusion' => 'Diagnosis menunjukkan bahwa pasien memiliki kadar gula darah yang tinggi, perlu pengobatan dan kontrol rutin.',
            'recommendation' => 'Disarankan untuk mengatur pola makan, olahraga teratur, dan melakukan pemeriksaan gula darah secara berkala.'
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

}
