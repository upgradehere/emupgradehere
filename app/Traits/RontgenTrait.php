<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\AnamnesisT;
use App\Models\RefractionT;
use App\Models\RontgenT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait RontgenTrait
{
    private function getDataRontgen ($mcu_id = null)
    {
        $model = new RontgenT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function saveRontgen(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $rontgen_id = isset($post['rontgen_id']) ? $post['rontgen_id'] : null;
            // if ($action == 'delete') {
            //     return self::actionDeleteAnamnesis($refraction_id);
            // }
            // return $request->file('image_file')->getMimeType();
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
                $path = 'uploads/rontgen/';
                $file->move($path, $filename);
            }

            DB::beginTransaction();
            $model = new RontgenT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['rontgen_date'] = date('Y-m-d H:i:s');
            if (!empty($rontgen_id)) {
                $query = $model->find($rontgen_id);
                if ($query != null) {
                    $model = $model->find($rontgen_id);
                    $post['rontgen_id'] = $rontgen_id;
                }
            } else {
                unset($post['rontgen_id']);
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

    // private function actionDeleteAnamnesis ($anamnesis_id)
    // {
    //     try {
    //         if (empty($anamnesis_id)){
    //             return redirect()->back()->with([
    //                 'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
    //             ]);
    //         }
    //         $model = AnamnesisT::find($anamnesis_id);
    //         $model->delete();
    //         return redirect()->back()->with([
    //             'success' => ConstantsHelper::MESSAGE_SUCCESS_DELETE
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->back()->with([
    //             'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
    //         ]);
    //     }
    // }

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
