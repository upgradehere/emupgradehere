<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        $data = [];

        foreach ($settings as $val) {
            $data[strtolower($val['type'])] = $val['value1'];
        }

        return view('settings/index', $data);
    }

    public function otpUpdate(Request $request)
    {
        $rules = [
            'otp' => 'required',
            'twilio_sid' => 'required',
            'twilio_auth_token' => 'required',
        ];

        $messages = [
            'otp.required' => 'OTP wajib diisi',
            'twilio_sid.required' => 'Twilio SID wajib diisi',
            'twilio_auth_token.required' => 'Twilio Auth Token wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('settings');
        }

        foreach($request->all() as $type => $val) {
            if ($type == '_token') {
                continue;
            }

            $settings = Setting::where("type", $type)->first();
            $settings->value1 = $val;
    
            if ($settings->save()) {
            } else {
                session()->flash('error', 'Kesalahan terjadi, settingan baru '.$type.' gagal disimpan, harap hubungi Admin kami');
                return redirect()->route('settings');
            }
        }

        session()->flash('success', 'Settingan telah diperbarui');
        return redirect()->route('settings');
    }
}
