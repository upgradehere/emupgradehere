<?php
namespace App\Traits;

use App\Helpers\ConstantsHelper;
use App\Models\RontgenT;
use App\Models\SpirometryT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait SpirometriTrait
{
    private function getDataSpirometry ($mcu_id = null)
    {
        $model = new SpirometryT();
        $query = $model->select()->where('mcu_id', $mcu_id)->first();
        return $query;
    }

    public function saveSpirometry(Request $request)
    {
        try {
            $post = $request->post();
            $action = $request->input('action');
            $spirometry_id = isset($post['spirometry_id']) ? $post['spirometry_id'] : null;
            if ($action == 'delete') {
                return self::actionDeleteSpirometry($spirometry_id);
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
                $path = 'uploads/spirometry/';
                $file->move($path, $filename);
            }

            DB::beginTransaction();
            $model = new SpirometryT();
            if (empty($post['mcu_id'])) {
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_SAVE
                ]);
            }
            $post['spirometry_date'] = date('Y-m-d H:i:s');
            if (!empty($spirometry_id)) {
                $query = $model->find($spirometry_id);
                if ($query != null) {
                    $model = $model->find($spirometry_id);
                    $post['spirometry_id'] = $spirometry_id;
                }
            } else {
                unset($post['spirometry_id']);
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

    private function actionDeleteSpirometry ($spirometry_id)
    {
        try {
            if (empty($spirometry_id)){
                return redirect()->back()->with([
                    'error' => ConstantsHelper::MESSAGE_ERROR_DELETE
                ]);
            }
            $model = SpirometryT::find($spirometry_id);
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

}
