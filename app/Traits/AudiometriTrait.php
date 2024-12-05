<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\AudiometryT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait AudiometriTrait
{
    public function getDataAudiometry ($mcu_id)
    {
        $model = new AudiometryT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        $audiometry = [];
        if (!empty($query)) {
            $audiometry = $query;
            $audiometry['right_air_conduction'] = !empty($query['right_air_conduction']) ? json_decode($query['right_air_conduction']) : [];
            $audiometry['left_air_conduction'] = !empty($query['left_air_conduction']) ? json_decode($query['left_air_conduction']) : [];
            $audiometry['right_bone_conduction'] = !empty($query['right_bone_conduction']) ? json_decode($query['right_bone_conduction']) : [];
            $audiometry['left_bone_conduction'] = !empty($query['left_bone_conduction']) ? json_decode($query['left_bone_conduction']) : [];
        }
        return $audiometry;
    }

    public function saveAudiometry(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $audiometry_id = isset($post['audiometry_id']) ? $post['audiometry_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteAudiometry($audiometry_id);
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
            $post['image_file'] = null;
            $post['additional_data'] = null;
            if($request->has('image_file')){
                // return $request->file('image_file');
                $file = $request->file('image_file');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $post['image_file'] = $filename;
                $path = 'uploads/audiometry/';
                $file->move($path, $filename);
            }

            DB::beginTransaction();
            $model = new AudiometryT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $payload = [
                'mcu_id' => $post['mcu_id'],
                'audiometry_date' => date('Y-m-d H:i:s'),
                'right_air_conduction' => json_encode($post['right_air_conduction']),
                'left_air_conduction' => json_encode($post['left_air_conduction']),
                'right_bone_conduction' => json_encode($post['right_bone_conduction']),
                'left_bone_conduction' => json_encode($post['left_bone_conduction']),
                'right_ear' => $post['right_ear'],
                'left_ear' => $post['left_ear'],
                'conclusion' => $post['conclusion'],
                'suggestion' => $post['suggestion'],
                'doctor_id' => $post['doctor_id'],
                'image_file' => $post['image_file'],
                'additional_data' => $post['additional_data']
            ];
            if (!empty($audiometry_id)) {
                $query = $model->find($audiometry_id);
                if ($query != null) {
                    $model = $model->find($audiometry_id);
                    $payload['audiometry_id'] = $audiometry_id;
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

    private function actionDeleteAudiometry ($audiometry_id)
    {
        try {
            if (empty($audiometry_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = AudiometryT::find($audiometry_id);
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

    private function getDataPrintAudiometry($mcu_id)
    {
        $model = AudiometryT::select('*')->where('mcu_id', $mcu_id)->first();
        $data = $model;
        $data['right_air_conduction'] = !empty($model->right_air_conduction) ? json_decode($model->right_air_conduction, true) : [];
        $data['left_air_conduction'] = !empty($model->left_air_conduction) ? json_decode($model->left_air_conduction, true) : [];
        $data['right_bone_conduction'] = !empty($model->right_bone_conduction) ? json_decode($model->right_bone_conduction, true) : [];
        $data['left_bone_conduction'] = !empty($model->left_bone_conduction) ? json_decode($model->left_bone_conduction, true) : [];
        return $data;
    }
}
