<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\AnamnesisT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait AnamnesisTrait
{
    public function getDataAnamnesis ($mcu_id)
    {
        $model = new AnamnesisT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        $anamnesis = [];
        if (!empty($query)) {
            $anamnesis = $query;
            $anamnesis['medical_history'] = !empty($query['medical_history']) ? json_decode($query['medical_history']) : [];
            $anamnesis['habit_factor'] = !empty($query['habit_factor']) ? json_decode($query['habit_factor']) : [];
            $anamnesis['work_hazard_history'] = !empty($query['work_hazard_history']) ? json_decode($query['work_hazard_history']) : [];
            $anamnesis['eyes'] = !empty($query['eyes']) ? json_decode($query['eyes']) : [];
            $anamnesis['ears'] = !empty($query['ears']) ? json_decode($query['ears']) : [];
            $anamnesis['nose'] = !empty($query['nose']) ? json_decode($query['nose']) : [];
            $anamnesis['oral_cavity'] = !empty($query['oral_cavity']) ? json_decode($query['oral_cavity']) : [];
            $anamnesis['teeth'] = !empty($query['teeth']) ? json_decode($query['teeth']) : [];
            $anamnesis['neck'] = !empty($query['neck']) ? json_decode($query['neck']) : [];
            $anamnesis['thorax'] = !empty($query['thorax']) ? json_decode($query['thorax']) : [];
            $anamnesis['abdomen'] = !empty($query['abdomen']) ? json_decode($query['abdomen']) : [];
            $anamnesis['spine'] = !empty($query['spine']) ? json_decode($query['spine']) : [];
            $anamnesis['upper_extremities'] = !empty($query['upper_extremities']) ? json_decode($query['upper_extremities']) : [];
            $anamnesis['lower_extremities'] = !empty($query['lower_extremities']) ? json_decode($query['lower_extremities']) : [];
            $anamnesis['additional_data'] = !empty($query['thorax']) ? json_decode($query['additional_data']) : [];
        }
        return $anamnesis;
    }

    public function saveAnamnesis(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $anamnesis_id = isset($post['anamnesis_id']) ? $post['anamnesis_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteAnamnesis($anamnesis_id);
            }
            DB::beginTransaction();
            $model = new AnamnesisT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $payload = [
                'anamnesis_code' => '-',
                'anamnesis_date' => date('Y-m-d H:i:s'),
                'mcu_id' => $post['mcu_id'],
                'systolic' => $post['systolic'],
                'diastolic' => $post['diastolic'],
                'pulse_rate' => $post['pulse_rate'],
                'breathing' => $post['breathing'],
                'height' => $post['height'],
                'weight' => $post['weight'],
                'weight_recommended' => $post['weight_recommended'],
                'bmi' => $post['bmi'],
                'body_temprature' => $post['body_temprature'],
                'bmi_classification' => $post['bmi_classification'],
                'skin_condition' => $post['skin_condition'],
                'medical_history' => json_encode($post['medical_history']),
                'habit_factor' => json_encode($post['habit_factor']),
                'work_hazard_history' => json_encode($post['work_hazard_history']),
                'eyes' => json_encode($post['eyes']),
                'ears' => json_encode($post['ears']),
                'nose' => json_encode($post['nose']),
                'oral_cavity' => json_encode($post['oral_cavity']),
                'teeth' => json_encode($post['teeth']),
                'neck' => json_encode($post['neck']),
                'thorax' => json_encode($post['thorax']),
                'abdomen' => json_encode($post['abdomen']),
                'spine' => json_encode($post['spine']),
                'upper_extremities' => json_encode($post['upper_extremities']),
                'lower_extremities' => json_encode($post['lower_extremities']),
                'additional_data' => null,
                'notes' => $post['notes'],
            ];
            if (!empty($anamnesis_id)) {
                $query = $model->find($anamnesis_id);
                if ($query != null) {
                    $model = $model->find($anamnesis_id);
                    $payload['anamnesis_id'] = $anamnesis_id;
                }
            }
            $model->attributes = $payload;
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
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with([
                'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
            ]);
        }
    }

    private function actionDeleteAnamnesis ($anamnesis_id)
    {
        try {
            if (empty($anamnesis_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = AnamnesisT::find($anamnesis_id);
            $model->delete();
            return redirect()->back()->with([
                'success' => ConstantsHelper::MESSAGE_SUCCESS_DELETE
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with([
                'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
            ]);
        }
    }

    private function getDataPrintAnamnesis($mcu_id)
    {
        $model = AnamnesisT::select('*')->where('mcu_id', $mcu_id)->first();
        return $model;
    }

    private function mappingJsonData($skip = [], $data) {
        $mappedData = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $skip)) {
                $mappedData[$key] = ($value == 0) ? 'Tidak' : (($value == 1) ? 'Ya' : $value);
            } else {
                $mappedData[$key] = $value;
            }
        }
        return $mappedData;
    }

}
