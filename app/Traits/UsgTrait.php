<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\UsgT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait UsgTrait
{
    private function getDataUsg ($mcu_id = null)
    {
        $model = new UsgT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function saveUsg(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $usg_id = isset($post['usg_id']) ? $post['usg_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteUsg($usg_id);
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
                $path = 'uploads/usg/';
                $file->move($path, $filename);
            }

            DB::beginTransaction();
            $model = new UsgT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['usg_date'] = date('Y-m-d H:i:s');
            if (!empty($usg_id)) {
                $query = $model->find($usg_id);
                if ($query != null) {
                    $model = $model->find($usg_id);
                    $post['usg_id'] = $usg_id;
                }
            } else {
                unset($post['usg_id']);
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

    private function actionDeleteUsg ($usg_id)
    {
        try {
            if (empty($usg_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = UsgT::find($usg_id);
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

    private function getDataPrintUsg($mcu_id)
    {
        $model = UsgT::select('*')->where('mcu_id', $mcu_id)->first();
        return $model;
    }
}
