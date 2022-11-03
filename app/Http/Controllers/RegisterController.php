<?php

namespace App\Http\Controllers;

use App\Http\Services\sendOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

// Models
use App\Models\Anggota;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct(sendOTP $sendOTP)
    {
        $this->sendOTP = $sendOTP;
    }

    public function index()
    {
        return view('auth.register');
    }

    public function checkNIK(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|digits:16'
        ]);

        $nik = $request->nik;

        //* Check NIK
        $anggota = Anggota::where('nik', $nik)->first();
        if (!$anggota) {
            $validator->errors()->add('nik', 'NIK belum terdaftar, Silahkan hubungi RT setempat.');
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        } else {
            return redirect()
                ->route('register.verification', $nik);
        }

        return redirect('/register')
            ->withErrors($validator)
            ->withInput();
    }

    public function verification($nik)
    {
        $anggota = Anggota::where('nik', $nik)->first();

        $checkUser = User::where('nik', $nik)->first();
        if ($checkUser) {
            /**
             * 1. user_pengajuan (update)
             * 2. Send OTP
             */

            $kode = mt_rand(1000, 9999);

            //* Tahap 1
            $this->updateKode($nik, $kode);

            //* Tahap 2
            $this->sendOTP->sendOTP($kode, $checkUser->no_telp);

            return redirect()
                ->route('register.activation', ['nik' => $nik, 'no_hp' => $checkUser->no_telp]);
        }

        return view('auth.verification', compact('nik', 'anggota'));
    }

    public function sendOTP(Request $request, $nik)
    {
        /**
         * Tahapan 
         * 1. user_pengajuan (store)
         * 2. Send OTP
         */

        $kode = mt_rand(1000, 9999);
        $no_hp = $request->no_hp;

        //* Tahap 1
        $dataInput = [
            'nik' => $nik,
            'no_telp' => $no_hp,
            'kode' => $kode
        ];
        User::create($dataInput);

        //* Tahap 2
        $this->sendOTP->sendOTP($kode, $no_hp);

        return redirect()
            ->route('register.activation', ['nik' => $nik, 'no_hp' => $no_hp]);
    }

    public function activation($nik, $no_hp)
    {
        $data = User::where('nik', $nik)->first();

        return view('auth.activation', compact('nik', 'no_hp', 'data'));
    }

    public function resendOTP($nik, $no_hp)
    {
        /**
         * 1. user_pengajuan (update)
         * 2. Send OTP
         */

        $kode = mt_rand(1000, 9999);

        //* Tahap 1
        $this->updateKode($nik, $kode);

        //* Tahap 2
        $this->sendOTP->sendOTP($kode, $no_hp);

        return redirect()
            ->route('register.activation', ['nik' => $nik, 'no_hp' => $no_hp])
            ->withSuccess('Kode OTP berhasil terkirim.');
    }

    public static function updateKode($nik, $kode)
    {
        User::where('nik', $nik)->update([
            'kode' => $kode
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|numeric|digits:4',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ], [
            'confirm_password.same' => 'Konfirmasi Password tidak sama dengan password.',
            'confirm_password.min' => 'Konfirmasi Password minimal berisi 8 karakter.'
        ]);

        /**
         * Tahapan
         * 1. Check OTP
         * 2. user_pengajuan (store)
         */

        $no_hp = $request->no_hp;
        $nik   = $request->nik;
        $kode  = $request->kode;
        $password = $request->password;

        //* Tahap 1
        $user = User::where('nik', $nik)->first();
        if ($user->kode != $kode) {
            return redirect()
                ->route('register.activation', ['nik' => $nik, 'no_hp' => $no_hp])
                ->withErrors('Kode OTP tidak sesuai.')
                ->withInput();
        }

        //* Tahap 2
        $user->update([
            'password' => \md5($password)
        ]);

        if ($validator) {
            return redirect()
                ->route('register.activation', ['nik' => $nik, 'no_hp' => $no_hp])
                ->withErrors($validator)
                ->withInput();
        } else {
            return redirect()
                ->route('register.activation', ['nik' => $nik, 'no_hp' => $no_hp]);
        }
    }
}
