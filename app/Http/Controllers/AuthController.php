<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
                // SEND OTP

                $update = User::find($user->id);
                $update->otp = rand(000001,999999); 
                $update->otp_expired = Carbon::now()->addMinutes(2); 
                $update->save();

                if ($update) {
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
                        'data' => 'Kesalahan terjadi, harap hubungi Admin kami',
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
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Login failed',
                'data' => 'Email atau Password tidak terdaftar',
            ];

            return response()->json($data, 200);
        }
    }

    public function otp(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'otp' => 'required',
        ];

        $messages = [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
            'otp.required' => 'OTP wajib diisi',
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
        $otp = $request->otp;

        $user = User::where('email', $email)
            ->with('role')
            ->first();

        if ($user) {
            if (Hash::check($password, $user->password) && $otp == $user->otp) {
                $now = Carbon::now();
                $otp_expired = $user->otp_expired;
                if ($now < $otp_expired) {
                    $cred = [
                        'email'     => $email,
                        'password'  => $password,
                    ];
                    
                    Auth::attempt($cred);

                    if (Auth::check()) { 
                        $data = [
                            'status' => 'success',
                            'message' => 'Login success',
                            'data' => '',
                        ];
                    } else {
                        $data = [
                            'status' => 'error',
                            'message' => 'Login failed',
                            'data' => 'Email atau Password atau OTP tidak terdaftar',
                        ];
                    }

    
                    return response()->json($data, 200);                    
                } else {
                    $data = [
                        'status' => 'error',
                        'message' => 'Login failed',
                        'data' => 'OTP Expired',
                    ];
    
                    return response()->json($data, 200);
                }

            } else {
                $data = [
                    'status' => 'error',
                    'message' => 'Login failed',
                    'data' => 'Email atau Password atau OTP tidak terdaftar',
                ];

                return response()->json($data, 200);
            }
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Login failed',
                'data' => 'Email atau Password atau OTP tidak terdaftar',
            ];

            return response()->json($data, 200);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
