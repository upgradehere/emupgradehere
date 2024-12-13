<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class PasswordController extends Controller
{
    public function index()
    {
        return view('password/index');
    }

    public function store(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'old_password.required' => 'Password lama wajib diisi',
            'password.required' => 'Password baru wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all(); 

            session()->flash('error', $messages);

            return redirect()->route('change-password');
        }

        $auth = Auth::user();
        $id = $auth->id;
        
        $user = User::find($id);

        if ($user) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);

                if ($user->save()) {
                    session()->flash('success', 'Password berhasil diubah');
                } else {
                    session()->flash('error', 'Kesalahan terjadi, Password gagal diubah, harap hubungi Admin kami');
                }
            } else {
                session()->flash('error', 'Password lama tidak sesuai');
            }
        } else {
            session()->flash('error', 'User tidak ditemukan');
        }

        return redirect()->route('change-password');
    }
}
