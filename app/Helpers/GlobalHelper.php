<?php
namespace App\Helpers;

use App\Models\LaboratoryExaminationM;
use App\Models\LookupC;
use App\Models\PackageM;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

            if (Auth::user()->id_role == 3) {
                foreach($examination_types as $key => $val) {
                    if (Auth::user()->examination_type != 30) {
                        if ($val != Auth::user()->examination_type) {
                            unset($examination_types[$key]);
                        }
                    }
                }
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

    public static function dataTable($request, $query)
    {
        $totalRecords = $query->count();
        $search = [];

        foreach ($request['columns'] as $column) {
            if (isset($column['searchable']) && $column['searchable'] === 'true' && isset($column['data'])) {
                $search[] = $column['data'];
            }
        }
        if ($request->has('search') && !empty($request['search']['value'])) {
            $searchValue = $request['search']['value'];
            $query = $query->where(function ($q) use ($search, $searchValue) {
                foreach ($search as $column) {
                    if (strpos($column, '.') === false) {
                        $q->orWhere($column, 'ilike', '%' . $searchValue . '%');
                    } else {
                        $arr = explode(".", $column);
                        $q->orWhereHas($arr[0], function ($qRel) use ($arr, $searchValue) {
                            $qRel->where($arr[1], 'ilike', '%' . $searchValue . '%');
                        });
                    }
                }
            });
        }
        $filteredRecords = $query->count();
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
        return [
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];
    }

}
