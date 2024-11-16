<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return view('login.index');
    }

    public function check(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $data = [
                'status' => 'error',
                'message' => 'Login failed',
                'data' => $validator->errors()->all(),
            ];

            return response()->json($data, 200);
        }

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)
            ->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                // SEND EMAIL OTP
                $data = [
                    'status' => 'success',
                    'message' => 'Credential check success',
                    'data' => '',
                ];

                return response()->json($data, 200);
            } else {
                $data = [
                    'status' => 'error',
                    'message' => 'Login failed',
                    'data' => 'Email atau Password tidak terdaftar',
                ];

                return response()->json($data, 200);
            }
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Login failed',
                'data' => 'Email atau Password tidak terdaftar',
            ];

            return response()->json($data, 200);
        }
    }
}
