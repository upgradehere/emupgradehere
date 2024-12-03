<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\AnamnesisT;
use App\Models\LaboratoryDetailT;
use App\Models\LaboratoryExaminationGroupM;
use App\Models\LaboratoryExaminationM;
use App\Models\LaboratoryExaminationTypeM;
use App\Models\LaboratoryT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait LaboratoriumTrait
{

    private function getFormLab ($mcu_id, $laboratory_examintaions)
    {
        $labT = LaboratoryT::select('laboratory_t.laboratory_id')
        ->where('mcu_id', $mcu_id)
        ->leftJoin('laboratory_detail_t', 'laboratory_detail_t.laboratory_id', '=', 'laboratory_t.laboratory_id')
        ->first();

        $data = [];
        if (empty($labT)) {
            $groups = LaboratoryExaminationGroupM::with(['examinationTypes.examinations'])->get();
            foreach ($groups as $group) {
                foreach ($group->examinationTypes as $type) {
                    $type->examinations = LaboratoryExaminationM::select(
                        'laboratory_examination_m.laboratory_examination_id',
                        'laboratory_examination_m.laboratory_examination_code',
                        'laboratory_examination_m.laboratory_examination_name',
                        'laboratory_reference_value_m.unit',
                        'laboratory_reference_value_m.reference_value',
                    )
                    ->leftJoin('laboratory_reference_value_m', 'laboratory_reference_value_m.laboratory_examination_id', '=', 'laboratory_examination_m.laboratory_examination_id')
                    ->where('laboratory_examination_type_id', $type->laboratory_examination_type_id)
                    ->whereIn('laboratory_examination_m.laboratory_examination_id', $laboratory_examintaions)
                    ->get();
                }
            }
        } else {
            $groups = LaboratoryExaminationGroupM::with(['examinationTypes.examinations'])->get();
            foreach ($groups as $group) {
                foreach ($group->examinationTypes as $type) {
                    $type->examinations = LaboratoryExaminationM::select(
                        'laboratory_examination_m.laboratory_examination_id',
                        'laboratory_examination_m.laboratory_examination_code',
                        'laboratory_examination_m.laboratory_examination_name',
                        'laboratory_reference_value_m.unit',
                        'laboratory_reference_value_m.reference_value',
                        'laboratory_detail_t.result',
                        'laboratory_detail_t.is_abnormal',
                    )
                    ->leftJoin('laboratory_reference_value_m', 'laboratory_reference_value_m.laboratory_examination_id', '=', 'laboratory_examination_m.laboratory_examination_id')
                    ->leftJoin('laboratory_detail_t', 'laboratory_detail_t.laboratory_examination_id', '=', 'laboratory_examination_m.laboratory_examination_id')
                    ->leftJoin('laboratory_t', 'laboratory_t.laboratory_id', '=', 'laboratory_detail_t.laboratory_id')
                    ->where('laboratory_examination_type_id', $type->laboratory_examination_type_id)
                    ->whereIn('laboratory_examination_m.laboratory_examination_id', $laboratory_examintaions);


                    $labDetailT = LaboratoryDetailT::select('*')->where('laboratory_id', $labT->laboratory_id)->first();
                    if (!empty($labDetailT)) {
                        $type->examinations->where(function ($query) use ($mcu_id) {
                            $query->whereNull('laboratory_t.laboratory_id')
                                ->orWhere('laboratory_t.mcu_id', $mcu_id);
                        });
                    }
                    $type->examinations = $type->examinations->get();
                    // $type->examinations = $type->examinations;
                    $type->examinations->result = 1;
                    Log::info($type->examinations);
                }
            }
            $data['laboratory_id'] = $labT->laboratory_id;
        }

        $data['groups'] = $groups;
        return $data;
    }

    public function saveLab(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $laboratory_id = isset($post['laboratory_id']) ? $post['laboratory_id'] : null;

            DB::beginTransaction();
            $model = new LaboratoryT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $payload = [
                'mcu_id' => $post['mcu_id'],
                'laboratory_date' => date('Y-m-d H:i:s'),
            ];
            if (!empty($laboratory_id)) {
                $query = $model->find($laboratory_id);
                if ($query != null) {
                    $model = $model->find($laboratory_id);
                    $payload['laboratory_id'] = $laboratory_id;
                }
            }
            $model->attributes = $payload;
            if ($model->validate() === true) {
                if ($model->save()) {
                    LaboratoryDetailT::where('laboratory_id', $model->laboratory_id)->delete();
                    $data['results'] = array_filter($post['results'], function($item) {
                        return $item['result'] !== null;
                    });
                    foreach ($data['results'] as $key => $result) {
                        $data['results'][$key]['laboratory_id'] = $model->laboratory_id;
                        $data['results'][$key]['is_abnormal'] = !empty($result['is_abnormal']) ? $result['is_abnormal'] : 0;
                    }
                    LaboratoryDetailT::insert($data['results']);
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

}
