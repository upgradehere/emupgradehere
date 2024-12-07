<?php
namespace App\Helpers;

use App\Models\LaboratoryExaminationM;
use App\Models\LookupC;
use App\Models\PackageM;
use Illuminate\Support\Facades\Validator;

class GlobalHelper {
    public static function validation($data, $rules, $messages, $attributes = null){
        if (isset($data)) {
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                // return json_decode($validator->messages(), true);
                $string = implode(', ', $validator->messages()->all());
                return $string;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function getMcuPackage($package_id = null)
    {
        $package = PackageM::select('*')->where('id', $package_id)->first();
        $examination_types = [];

        if ($package) {
            $package_code = $package->package_code;
            $package_name = $package->package_name;
            if (!empty($package->anamnesis)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_ANAMNESIS;
            }
            if (!empty($package->rontgen)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RONTGEN;
            }
            if (!empty($package->audiometry)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_AUDIOMETRY;
            }
            if (!empty($package->spirometry)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_SPIROMETRY;
            }
            if (!empty($package->ekg)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_EKG;
            }
            if (!empty($package->usg)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_USG;
            }
            if (!empty($package->treadmill)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_TREADMILL;
            }
            if (!empty($package->papsmear)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_PAPSMEAR;
            }
            if (!empty($package->lab)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_LAB;
            }
            if (!empty($package->refraction)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_REFRACTION;
            }
            if (!empty($package->resume)) {
                $examination_types[] = ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RESUME_MCU;
            }

            $lookup = LookupC::select('lookup_id', 'lookup_code', 'lookup_name', 'additional_data')
                ->whereIn('lookup_id', $examination_types)
                ->orderBy('lookup_id', 'asc')
                ->get();

            $examinations = $lookup->map(function ($examination) {
                $data = json_decode($examination->additional_data, true);
                return [
                    'lookup_id' => $examination->lookup_id,
                    'lookup_code' => $examination->lookup_code,
                    'lookup_name' => $examination->lookup_name,
                    'tab_name' => $data['tab_name'] ?? null,
                ];
            });

            if (!empty($package->lab)) {
                $laboratory_examinations = json_decode($package->lab, true);
            }

            return [
                'package_code' => $package_id,
                'package_code' => $package_code,
                'package_name' => $package_name,
                'examinations' => $examinations,
                'laboratory_examinations' => $laboratory_examinations
            ];
        } else {
            return [];
        }
    }

}
