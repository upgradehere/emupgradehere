<?php
namespace App\Helpers;

use App\Models\LaboratoryExaminationM;
use App\Models\LookupC;
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
        $lookup = LookupC::select('lookup_id', 'lookup_code', 'lookup_name', 'additional_data')
            ->whereIn('lookup_id', [20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30])
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

        $examinations_examinations = LaboratoryExaminationM::select('laboratory_examination_id', 'laboratory_examination_type_id', 'laboratory_examination_code')
        ->whereIn('laboratory_examination_id', [1,2,3,20,21,22,58])
        ->pluck('laboratory_examination_id')
        ->toArray();

        return [
            'examinations' => $examinations,
            'laboratory_examinations' => $examinations_examinations
        ];
    }

}
