<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\ResumeMcuT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ResumeMcuTrait
{
    private function getDataResumeMcu ($mcu_id = null)
    {
        $model = new ResumeMcuT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function saveResumeMcu(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $resume_mcu_id = isset($post['resume_mcu_id']) ? $post['resume_mcu_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteResumeMcu($resume_mcu_id);
            }

            DB::beginTransaction();
            $model = new ResumeMcuT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['resume_mcu_date'] = date('Y-m-d H:i:s');
            if (!empty($resume_mcu_id)) {
                $query = $model->find($resume_mcu_id);
                if ($query != null) {
                    $model = $model->find($resume_mcu_id);
                    $post['resume_mcu_id'] = $resume_mcu_id;
                }
            } else {
                unset($post['resume_mcu_id']);
            }
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
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with([
                'error' => ConstantsHelper::MESSAGE_ERROR_SAVE.' '.$e->getMessage()
            ]);
        }
    }

    private function actionDeleteResumeMcu ($resume_mcu_id)
    {
        try {
            if (empty($resume_mcu_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = ResumeMcuT::find($resume_mcu_id);
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

    private function getDataPrintResume($mcu_id)
    {
        $model = ResumeMcuT::select('*')->where('mcu_id', $mcu_id)->first();
        return $model;
    }
}
