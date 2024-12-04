<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\TreadmillT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait TreadmillTrait
{
    private function getDataTreadmill ($mcu_id = null)
    {
        $model = new TreadmillT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function saveTreadmill(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $treadmill_id = isset($post['treadmill_id']) ? $post['treadmill_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteTreadmill($treadmill_id);
            }
            $request->validate(
                [
                    'image_file' => [
                        'nullable',
                        'image',
                        'mimes:jpeg,png,jpg',
                        'max:512',
                    ],
                ],
                [
                    'image_file.image' => 'File harus berupa gambar.',
                    'image_file.mimes' => 'Hanya ekstensi JPEG, PNG, and JPG yang diizinkan.',
                    'image_file.max' => 'Gambar tidak boleh lebih dari 512KB.',
                ]
            );
            if($request->has('image_file')){
                // return $request->file('image_file');
                $file = $request->file('image_file');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $post['image_file'] = $filename;
                $path = 'uploads/treadmill/';
                $file->move($path, $filename);
            }

            DB::beginTransaction();
            $model = new TreadmillT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['treadmill_date'] = date('Y-m-d H:i:s');
            if (!empty($treadmill_id)) {
                $query = $model->find($treadmill_id);
                if ($query != null) {
                    $model = $model->find($treadmill_id);
                    $post['treadmill_id'] = $treadmill_id;
                }
            } else {
                unset($post['treadmill_id']);
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

    private function actionDeleteTreadmill ($treadmill_id)
    {
        try {
            if (empty($treadmill_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = TreadmillT::find($treadmill_id);
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

    // private function getDataPrintAnamnesis($mcu_id)
    // {
    //     $model = AnamnesisT::select('*')->where('mcu_id', $mcu_id)->first();
    //     $data = $model;
    //     if (!empty($model->medical_history)) {
    //         $data['medical_history'] = $this->mappingJsonData(
    //             ['surgical_history_notes', 'epilepsy_notes', 'main_complaint'],
    //             json_decode($model->medical_history, true)
    //         );
    //     } else {
    //         $data['medical_history'] = null;
    //     }
    //     return $data;
    // }

    // private function mappingJsonData($skip = [], $data) {
    //     $mappedData = [];
    //     foreach ($data as $key => $value) {
    //         if (!in_array($key, $skip)) {
    //             $mappedData[$key] = ($value == 0) ? 'Tidak' : (($value == 1) ? 'Ya' : $value);
    //         } else {
    //             $mappedData[$key] = $value;
    //         }
    //     }
    //     return $mappedData;
    // }
}
