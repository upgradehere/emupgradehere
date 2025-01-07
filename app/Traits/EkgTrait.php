<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\EkgT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait EkgTrait
{
    private function getDataEkg ($mcu_id = null)
    {
        $model = new EkgT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function saveEkg(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $ekg_id = isset($post['ekg_id']) ? $post['ekg_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteEkg($ekg_id);
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
                $file = $request->file('image_file');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::uuid().'.'.$extension;
                $images = !empty($post['existing_images']) ? json_decode($post['existing_images'], true) : [];
                $images[] = $filename;
                $post['image_file'] = json_encode($images);
                $path = 'uploads/ekg/';
                $file->move($path, $filename);
            }
            unset($post['existing_images']);

            DB::beginTransaction();
            $model = new EkgT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['ekg_date'] = date('Y-m-d H:i:s');
            if (!empty($ekg_id)) {
                $query = $model->find($ekg_id);
                if ($query != null) {
                    $model = $model->find($ekg_id);
                    $post['ekg_id'] = $ekg_id;
                }
            } else {
                unset($post['ekg_id']);
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

    private function actionDeleteEkg ($ekg_id)
    {
        try {
            if (empty($ekg_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = EkgT::find($ekg_id);
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

    private function getDataPrintEkg($mcu_id)
    {
        $model = EkgT::select('*')->where('mcu_id', $mcu_id)->first();
        return $model;
    }
}
