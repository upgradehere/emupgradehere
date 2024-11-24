<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class GlobalHelper {
    public static function validation($data, $rules, $messages, $attributes = null){
        if (isset($data)) {
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                // return json_decode($validator->messages(), true);
                $string = implode(', ', $validator->messages()->all());
                return $string;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

}
