<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        if ($auth) {
            return redirect()->route('dashboard');
        }
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
                $update = User::find($user->id);

                if ($update->id_role == 1) {
                     $cred = [
                        'email'     => $email,
                        'password'  => $password,
                    ];
                    
                    Auth::attempt($cred);

                    if (Auth::check()) { 
                        $data = [
                            'status' => 'success|pass',
                            'message' => 'Login success',
                            'data' => '',
                        ];

                        Session::flash('login_success', 'Selamat datang '.$user->name); 
                    } else {
                        $data = [
                            'status' => 'error',
                            'message' => 'Login failed',
                            'data' => 'Email atau Password atau OTP tidak terdaftar',
                        ];
                    }

                    return response()->json($data, 200);
                }

                $update->otp = random_int(100000, 999999);
                $update->otp_expired = Carbon::now()->addMinutes(2); 
                $update->save();

                if ($update) {
                    // SEND OTP
                    $sendOtp = $this->sendOtp($update);

                    if ($sendOtp['status'] == 200) {
                        $data = [
                            'status' => 'success',
                            'message' => 'Credential check success',
                            'data' => '',
                        ];
        
                        return response()->json($data, 200);
                    } else {
                        $data = [
                            'status' => 'error',
                            'message' => 'OTP send failed',
                            'data' => 'Kesalahan terjadi, OTP gagal terkirim, harap hubungi Admin kami',
                        ];
        
                        return response()->json($data, 200);
                    }
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

                        Session::flash('login_success', 'Selamat datang '.$user->name); 
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

    public function sendOtp($data)
    {
        $isDev = env('APP_OTP');

        if ($isDev == 1) {
            $sid    = env('TWILIO_SID');
            $token  = env('TWILIO_AUTH_TOKEN');
            $twilio = new Client($sid, $token);
            
            if (substr($data->phone_number, 0, 1) === '0') {
                $data->phone_number = '+62' . substr($data->phone_number, 1);
            }
    
            $message = $twilio->messages
                ->create("whatsapp:$data->phone_number",
                    array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "*$data->otp* adalah kode OTP login EM Health Anda, jika anda tidak merasa melakukan login, abaikan pesan ini dan jangan bagikan kode OTP yang terlampir. Kode OTP akan kadaluarsa dalam 2 menit."
                    )
                );
                
            if ($message->sid) {
                return ['status' => 200];
            } else {
                return ['status' => 500];
            }
        } else {
            return ['status' => 200];
        }
    }
}
