<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\PapsmearT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait PapsmearTrait
{
    private function getDataPapsmear ($mcu_id = null)
    {
        $model = new PapsmearT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function savePapsmear(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $papsmear_id = isset($post['papsmear_id']) ? $post['papsmear_id'] : null;
            if ($action == 'delete') {
                return self::actionDeletePapsmear($papsmear_id);
            }

            DB::beginTransaction();
            $model = new PapsmearT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['papsmear_date'] = date('Y-m-d H:i:s');
            if (!empty($papsmear_id)) {
                $query = $model->find($papsmear_id);
                if ($query != null) {
                    $model = $model->find($papsmear_id);
                    $post['papsmear_id'] = $papsmear_id;
                }
            } else {
                unset($post['papsmear_id']);
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

    private function actionDeletePapsmear ($papsmear_id)
    {
        try {
            if (empty($papsmear_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = PapsmearT::find($papsmear_id);
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

    private function getDataPrintPapsmear($mcu_id)
    {
        $model = PapsmearT::select('*')->where('mcu_id', $mcu_id)->first();
        return $model;
    }
}
