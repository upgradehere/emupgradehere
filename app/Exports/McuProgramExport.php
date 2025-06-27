<?php

namespace App\Exports;

use App\Models\McuT;
use App\Models\EmployeeM;
use App\Models\ResumeMcuT;
use App\Models\AnamnesisT;
use App\Models\LaboratoryT;
use App\Models\LaboratoryDetailT;
use App\Models\LaboratoryExaminationM;
use App\Models\PackageM;
use App\Models\RontgenT;
use App\Models\EkgT;
use App\Models\AudiometryT;
use App\Models\SpirometryT;
use App\Models\PapsmearT;
use App\Models\RefractionT;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class McuProgramExport implements FromCollection, WithHeadings
{
    protected $program_id;
    protected $headings;
    protected $finalResults;
    protected $labCodes;

    public function __construct($program_id)
    {
        $this->program_id = $program_id;
        $this->headings = [];
        $this->labCodes = [];
        $this->finalResults = [];

        $mcu_list = McuT::where('mcu_program_id', $this->program_id)->get();
        $this->collectLabCodes($mcu_list);
    }

    public function collection()
    {
        ini_set('max_execution_time', 300);
        $mcu_list = McuT::where('mcu_program_id', $this->program_id)->get();

        foreach ($mcu_list as $mcu) {
            $employee = EmployeeM::find($mcu->employee_id);
            $anamnesis = AnamnesisT::where('mcu_id', $mcu->mcu_id)->first();

            $row = [
                $employee->employee_name ?? '',
                $employee->nik ?? '',
                $employee->birthdate ?? '',
                $employee->gender ?? '',
                $employee->position ?? '',
                $anamnesis->systolic ?? '',
                $anamnesis->diastolic ?? '',
                $anamnesis->pulse_rate ?? '',
                $anamnesis->breathing ?? '',
                $anamnesis->height ?? '',
                $anamnesis->weight ?? '',
                $anamnesis->bmi ?? '',
                $anamnesis->body_temprature ?? '',
                $anamnesis->bmi_classification ?? '',
                $anamnesis->skin_condition ?? '',
                $this->formatAdditionalData($anamnesis->medical_history ?? ''),
                $this->formatAdditionalData($anamnesis->eyes ?? ''),
                $this->formatAdditionalData($anamnesis->ears ?? ''),
                $anamnesis->nose ?? '',
                $anamnesis->oral_cavity ?? '',
                $anamnesis->teeth ?? '',
                $anamnesis->neck ?? '',
                $anamnesis->thorax ?? '',
                $anamnesis->abdomen ?? '',
                $anamnesis->spine ?? '',
                $anamnesis->upper_extremities ?? '',
                $anamnesis->lower_extremities ?? '',
                $anamnesis->notes ?? '',
                $this->formatAdditionalData($anamnesis->additional_data ?? ''),
                $anamnesis->waist_circum ?? '',
                $anamnesis->weight_recommended ?? '',
                $anamnesis->habit_factor ?? '',
                $anamnesis->work_hazard_history ?? ''
            ];

            $lab_result_map = [];
            $lab_main = LaboratoryT::where('mcu_id', $mcu->mcu_id)->first();
            if ($lab_main) {
                $lab_details = LaboratoryDetailT::where('laboratory_id', $lab_main->laboratory_id)->get();
                foreach ($lab_details as $detail) {
                    $exam = LaboratoryExaminationM::find($detail->laboratory_examination_id);
                    if ($exam && isset($exam->laboratory_examination_code)) {
                        $lab_result_map[$exam->laboratory_examination_code] = $detail->result;
                    }
                }
            }

            foreach ($this->labCodes as $code) {
                $row[] = $lab_result_map[$code] ?? '';
            }

            $resume = ResumeMcuT::where('mcu_id', $mcu->mcu_id)->first();

            $rontgen = RontgenT::where('mcu_id', $mcu->mcu_id)->first();
            $row[] = $rontgen ? (
                ($rontgen->conclusion ?? '') .
                ' | Pulmo: ' . ($rontgen->pulmo ?? '') .
                ' | Cor: ' . ($rontgen->cor ?? '') .
                ' | Oss Costae: ' . ($rontgen->oss_costae ?? '') .
                ' | Sinus: ' . ($rontgen->diaphragmatic_sinus ?? '') .
                ' | Dx: ' . ($rontgen->clinical_diagnosis ?? '') .
                ' | Notes: ' . ($rontgen->notes ?? '')
            ) : '';

            $ekg = EkgT::where('mcu_id', $mcu->mcu_id)->first();
            $row[] = $ekg ? (
                ($ekg->conclusion ?? '') .
                ' | Rhythm: ' . ($ekg->rhythm ?? '') .
                ' | Rate: ' . ($ekg->rate ?? '') .
                ' | Axis: ' . ($ekg->axis ?? '') .
                ' | Abnormality: ' . ($ekg->abnormality ?? '') .
                ' | Sugg: ' . ($ekg->suggestion ?? '')
            ) : '';

            $audiometry = AudiometryT::where('mcu_id', $mcu->mcu_id)->first();
            $row[] = $audiometry ? (
                ($audiometry->conclusion ?? '') .
                ' | R: ' . ($audiometry->right_ear ?? '') .
                ' | L: ' . ($audiometry->left_ear ?? '') .
                ' | Sugg: ' . ($audiometry->suggestion ?? '') .
                ' | Detail: ' . $this->formatAdditionalData($audiometry->additional_data ?? '')
            ) : '';

            $spirometry = SpirometryT::where('mcu_id', $mcu->mcu_id)->first();
            $row[] = $spirometry ? (
                ($spirometry->conclusion ?? '') .
                ' | KVP: ' . ($spirometry->kvp ?? '') .
                ' | VEP: ' . ($spirometry->vep ?? '') .
                ' | APE: ' . ($spirometry->ape_total ?? '') .
                ' | Pred: ' . ($spirometry->prediction_value ?? '') .
                ' | Class: ' . ($spirometry->classification ?? '')
            ) : '';

            $papsmear = PapsmearT::where('mcu_id', $mcu->mcu_id)->first();
            $row[] = $papsmear->papsmear_result ?? '';

            $refraction = RefractionT::where('mcu_id', $mcu->mcu_id)->first();
            $row[] = $refraction ? (
                ($refraction->refraction_result ?? '') .
                ' | R: ' . ($refraction->right_eye ?? '') .
                ' | L: ' . ($refraction->left_eye ?? '')
            ) : '';

            $row[] = $resume ? (
                'Physical: ' . ($resume->physical_impression ?? '') .
                ' | Rontgen: ' . ($resume->rontgen_impression ?? '') .
                ' | EKG: ' . ($resume->ekg_impression ?? '') .
                ' | Audiometri: ' . ($resume->audiometry_impression ?? '') .
                ' | USG: ' . ($resume->usg_impression ?? '') .
                ' | Spirometri: ' . ($resume->spirometry_impression ?? '') .
                ' | Refraction: ' . ($resume->refreaction_impression ?? '') .
                ' | Lab: ' . ($resume->laboratory_impression ?? '') .
                ' | Kesimpulan: ' . ($resume->result_conclusion ?? '') .
                ' | Saran: ' . ($resume->suggestion ?? '')
            ) : '';

            $this->finalResults[] = $row;
        }

        return collect($this->finalResults);
    }

    private function formatAdditionalData($data)
    {
        $formatted = '';
        $decoded = json_decode($data, true);
        if (is_array($decoded)) {
            foreach ($decoded as $key => $value) {
                if ($value === '0' || $value === 0) {
                    $value = 'Normal';
                } elseif ($value === '1' || $value === 1) {
                    $value = 'Abnormal';
                } elseif (is_null($value)) {
                    $value = 'tidak di isi';
                }
                $formatted .= "$key: $value | ";
            }
            $formatted = rtrim($formatted, ' | ');
        }
        return $formatted;
    }

    public function collectLabCodes($mcu_list)
    {
        $codes = [];
        foreach ($mcu_list as $mcu) {
            $lab_main = LaboratoryT::where('mcu_id', $mcu->mcu_id)->first();
            if ($lab_main) {
                $lab_details = LaboratoryDetailT::where('laboratory_id', $lab_main->laboratory_id)->get();
                foreach ($lab_details as $detail) {
                    $exam = LaboratoryExaminationM::find($detail->laboratory_examination_id);
                    if ($exam && isset($exam->laboratory_examination_code)) {
                        $codes[] = $exam->laboratory_examination_code;
                    }
                }
            }
        }
        $this->labCodes = array_values(array_unique($codes));
    }

    public function headings(): array
    {
        if (empty($this->labCodes)) {
            $mcu_list = McuT::where('mcu_program_id', $this->program_id)->get();
            $this->collectLabCodes($mcu_list);
        }

        return array_merge(
            [
                'Nama', 'NIK', 'Tanggal Lahir', 'Jenis Kelamin', 'Posisi',
                'Systolic', 'Diastolic', 'Pulse Rate', 'Breathing',
                'Height', 'Weight', 'BMI', 'Body Temperature', 'BMI Classification',
                'Skin Condition', 'Medical History', 'Eyes', 'Ears', 'Nose',
                'Oral Cavity', 'Teeth', 'Neck', 'Thorax', 'Abdomen',
                'Spine', 'Upper Extremities', 'Lower Extremities', 'Notes',
                'Additional Data', 'Waist Circumference', 'Weight Recommended', 'Habit Factor', 'Work Hazard History'
            ],
            array_map(fn($code) => 'Lab: ' . $code, $this->labCodes),
            [
                'Hasil Rontgen', 'Hasil EKG', 'Hasil Audiometri', 'Hasil Spirometri', 'Hasil Pap Smear', 'Hasil Refraction', 'Resume MCU'
            ]
        );
    }
}
