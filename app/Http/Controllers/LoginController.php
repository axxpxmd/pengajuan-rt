<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\User;
use App\Models\Anggota;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|digits:16',
            'password' => 'required'
        ]);

        $nik = $request->nik;
        $password = $request->password;

        //* Check NIK
        $anggota = Anggota::where('nik', $nik)->first();
        if (!$anggota) {
            $validator->errors()->add('nik', 'NIK belum terdaftar, Silahkan hubungi RT setempat.');
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        //* Check Status Akun
        $user = User::where('nik', $nik)->first();
        if (!$user && $anggota) {
            $validator->errors()->add('nik', 'Akun anda belum aktif, Silahkan register untuk mengaktifkan akun.');
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $data = User::where('nik', $nik)
            ->wherepassword(md5($request->password))
            ->first();
        if ($data) {
            Auth::login($user, $request->remember);
            return redirect(route('dashboard'));
        } else {
            $validator->errors()->add('nik', 'Password yang dimasukan salah.');
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }
    }
}