<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\AnamnesisT;
use App\Models\RefractionT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait RefractionTrait
{
    private function getDataRefraction ($mcu_id = null)
    {
        $model = new RefractionT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function saveRefraction(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $refraction_id = isset($post['refraction_id']) ? $post['refraction_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteRefraction($refraction_id);
            }
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
                $file = $request->file('image_file');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::uuid().'.'.$extension;
                $images = !empty($post['existing_images']) ? json_decode($post['existing_images'], true) : [];
                $images[] = $filename;
                $post['image_file'] = $images;
                $path = 'uploads/refraction/';
                $file->move($path, $filename);
            }
            unset($post['existing_images']);

            DB::beginTransaction();
            $model = new RefractionT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['refraction_date'] = date('Y-m-d H:i:s');
            if (!empty($refraction_id)) {
                $query = $model->find($refraction_id);
                if ($query != null) {
                    $model = $model->find($refraction_id);
                    $post['refraction_id'] = $refraction_id;
                }
            } else {
                unset($post['refraction_id']);
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

    private function actionDeleteRefraction ($refraction_id)
    {
        try {
            if (empty($refraction_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = RefractionT::find($refraction_id);
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

    private function getDataPrintRefraction($mcu_id)
    {
        $model = RefractionT::select('*')->where('mcu_id', $mcu_id)->first();
        return $model;
    }

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
