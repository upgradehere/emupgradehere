<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\McuProgramM;
use App\Models\McuT;
use DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $id_company = null;

        if ($user->id_role == 2 || $user->id_role == 5 || ($user->id_role == 1 && !empty($user->id_company))) {
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
                'male' => $male,
                'female' => $female,
                'total' => $total,
            ];

        return $data;
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

        return $data;
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

        return $data;
    }

    public function getHealthCategory($id_program)
    {
        $lookupQuery = '
            SELECT lookup_id, lookup_name
            FROM lookup_c
            WHERE lookup_type = \'kesimpulan_mcu\'
        ';

        $lookupResults = DB::select($lookupQuery);

        $lookupMap = [];
        foreach ($lookupResults as $result) {
            $lookupMap[$result->lookup_id] = $result->lookup_name;
        }

        $query = '
            SELECT
                COUNT(CASE WHEN CAST(result_conclusion AS NUMERIC) = 31 THEN 1 END)::integer as fit_to_work,
                COUNT(CASE WHEN CAST(result_conclusion AS NUMERIC) = 32 THEN 1 END)::integer as fit_to_work_with_medical_note,
                COUNT(CASE WHEN CAST(result_conclusion AS NUMERIC) = 33 THEN 1 END)::integer as temporary_unfit,
                COUNT(CASE WHEN CAST(result_conclusion AS NUMERIC) = 34 THEN 1 END)::integer as need_further_examination,
                COUNT(CASE WHEN CAST(result_conclusion AS NUMERIC) = 35 THEN 1 END)::integer as fit_with_note
            FROM resume_mcu_t
            LEFT JOIN mcu_t ON mcu_t.mcu_id = resume_mcu_t.mcu_id
            WHERE mcu_program_id = ?
            AND mcu_t.deleted_at is null
            AND resume_mcu_t.deleted_at is null
        ';

        $results = DB::select($query, [$id_program]);

        $data = [
            ['value' => $results[0]->fit_to_work ?? 0, 'name' => $lookupMap[31]],
            ['value' => $results[0]->fit_to_work_with_medical_note ?? 0, 'name' => $lookupMap[32]],
            ['value' => $results[0]->temporary_unfit ?? 0, 'name' => $lookupMap[33]],
            ['value' => $results[0]->need_further_examination ?? 0, 'name' => $lookupMap[34]],
            ['value' => $results[0]->fit_with_note ?? 0, 'name' => $lookupMap[35]]
        ];

        return $data;
    }


    public function getMetabolicSyndrome($id_program)
    {
        $query = 'SELECT * FROM fn_metabolik_normal_abnormal(?)';

        $results = DB::select($query, [$id_program]);

        $data = [
            'normal' => $results[0]->count_normal ?? 0,
            'abnormal' => $results[0]->count_abnormal ?? 0
        ];

        return $data;
    }

    public function getDiseaseHistory($id_program)
    {
        $data = McuT::selectRaw("
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'asthma') = '1' THEN 1 END)::integer as asma,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'diabetes') = '1' THEN 1 END)::integer as kencing_manis,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'recurrent_seizures') = '1' THEN 1 END)::integer as kejang_kejang_berulang,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'heart_disease') = '1' THEN 1 END)::integer as penyakit_jantung,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'haemoptysis') = '1' THEN 1 END)::integer as batuk_disertai_dahak_berdarah,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'rheumatism') = '1' THEN 1 END)::integer as rheumatik,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'hypertension') = '1' THEN 1 END)::integer as tekanan_darah_tinggi,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'hypotension') = '1' THEN 1 END)::integer as tekanan_darah_rendah,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'angioedema') = '1' THEN 1 END)::integer as sering_bengkak_di_wajah_atau_kaki,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'surgical_history') = '1' THEN 1 END)::integer as riwayat_operasi,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'drug_continously') = '1' THEN 1 END)::integer as obat_terus_menerus,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'allergy') = '1' THEN 1 END)::integer as alergi,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'hepatitis') = '1' THEN 1 END)::integer as sakit_kuning_atau_hepatitis,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'drug_addiction') = '1' THEN 1 END)::integer as kecanduan_obat_obatan,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'fracture') = '1' THEN 1 END)::integer as patah_tulang,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'hearing_disorders') = '1' THEN 1 END)::integer as gangguan_pendengaran,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'pain_when_urinating') = '1' THEN 1 END)::integer as nyeri_saat_buang_air_kecil,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'white_discharge') = '1' THEN 1 END)::integer as sering_keputihan,
            COUNT(CASE WHEN (anamnesis_t.medical_history::json->>'epilepsy') = '1' THEN 1 END)::integer as epilepsi
        ")
        ->leftJoin('anamnesis_t', 'anamnesis_t.mcu_id', '=', 'mcu_t.mcu_id')
        ->where('mcu_t.mcu_program_id', $id_program)
        ->whereNull('mcu_t.deleted_at')
        ->whereNull('anamnesis_t.deleted_at')
        ->first()
        ->toArray();

        $result = [];
        foreach ($data as $key => $value) {
            $name = ucwords(str_replace('_', ' ', $key));
            $result[] = [
                "name" => $name,
                "diagnosis_count" => $value
            ];
        }

        usort($result, function($a, $b) {
            return $b['diagnosis_count'] <=> $a['diagnosis_count'];
        });

        return array_slice($result, 0, 10);
    }

    public function getLabDiagnosis($id_program)
    {
        $query = "
            SELECT
                laboratory_detail_t.laboratory_examination_id,
                laboratory_examination_m.laboratory_examination_name,
                laboratory_examination_m.laboratory_examination_id,
                COUNT(laboratory_detail_t.laboratory_examination_id) as count,
                COUNT(CASE WHEN e_m.sex = 11 THEN laboratory_detail_t.laboratory_examination_id END) as count_male,
                COUNT(CASE WHEN e_m.sex = 12 THEN laboratory_detail_t.laboratory_examination_id END) as count_female,
                mcu_t.mcu_program_id
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
                AND mcu_t.mcu_program_id = ?
            GROUP BY laboratory_detail_t.laboratory_examination_id, laboratory_examination_m.laboratory_examination_name, laboratory_examination_m.laboratory_examination_id, mcu_t.mcu_program_id
            ORDER BY count DESC
            LIMIT 10
        ";

        $result = DB::select($query, [$id_program]);
        $data = [];

        foreach ($result as $row) {
            $data[] = [
                'name' => $row->laboratory_examination_name,
                'id' => $row->laboratory_examination_id,
                'male' => $row->count_male,
                'female' => $row->count_female
            ];
        }

        return $data;
    }

    public function getNonLabDiagnosis($id_program)
    {
         $query = "
            SELECT
                key,
                COUNT(*) AS condition_count
            FROM
                anamnesis_t
            LEFT JOIN
                mcu_t ON mcu_t.mcu_id = anamnesis_t.mcu_id,
                jsonb_each_text(anamnesis_t.medical_history::jsonb) AS medical_conditions(key, value)
            WHERE
                value = '1'
                AND mcu_t.mcu_program_id = ?
                AND mcu_t.deleted_at is null
                AND anamnesis_t.deleted_at is null
            GROUP BY
                key
            ORDER BY
                condition_count DESC
            LIMIT 8;
        ";

        $results = DB::select($query, [$id_program]);

        $data = collect($results)->map(function ($item) {
            return [
                'name' => ucfirst(str_replace('_', ' ', $item->key)),
                'code' => $item->key,
                'abnormal' => $item->condition_count,
            ];
        });

        return $data;
    }

    public function getSymptoms($id_program)
    {
        $query = 'SELECT * FROM fn_sindrom_metabolik(?)';
        $results = DB::select($query, [$id_program]);

        $data = [];
        foreach ($results as $row) {
            $json_data = json_decode($row->json_data, true);

            $diseaseData = [
                'disease' => ucwords(str_replace("_", " ", $row->name)),
                'diagnoses' => []
            ];

            foreach ($json_data as $key => $count) {
                $formattedKey = ucwords(str_replace("_", " ", $key));
                $diseaseData['diagnoses'][$formattedKey] = $count;
            }

            $data[] = $diseaseData;
        }

        return $data;
    }


    public function getConclusionAndRecommendation($id_program)
    {
        $programs = McuProgramM::where("mcu_program_id", $id_program)
                                        ->first();
        $data = [
            'conclusion' => $programs->conclusion,
            'recommendation' => $programs->suggestion
        ];

        return $data;
    }

    public function getAllDataChart($program_id)
    {
        set_time_limit(120);
        $genderData = $this->getGender($program_id);
        $participantData = $this->getParticipant($program_id);
        $ageData = $this->getAge($program_id);
        $healthCategoryData = $this->getHealthCategory($program_id);
        $metabolicSyndromeData = $this->getMetabolicSyndrome($program_id);
        $diseaseHistoryData = $this->getDiseaseHistory($program_id);
        $labDiagnosisData = $this->getLabDiagnosis($program_id);
        $nonLabDiagnosisData = $this->getNonLabDiagnosis($program_id);
        $symptomsData = $this->getSymptoms($program_id);
        $conclusionAndRecommendationData = $this->getConclusionAndRecommendation($program_id);

        $data = [
            'status' => 'success',
            'data' => [
                'gender' => $genderData,
                'participant' => $participantData,
                'age' => $ageData,
                'health_category' => $healthCategoryData,
                'metabolic_syndrome' => $metabolicSyndromeData,
                'disease_history' => $diseaseHistoryData,
                'lab_diagnosis' => $labDiagnosisData,
                'non_lab_diagnosis' => $nonLabDiagnosisData,
                'symptoms' => $symptomsData,
                'conclusion_and_recommendation' => $conclusionAndRecommendationData,
            ]
        ];

        return response()->json($data);
    }

}
