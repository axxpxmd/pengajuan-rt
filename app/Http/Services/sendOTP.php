<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class sendOTP
{
    public static function sendOTP($kode, $no_hp)
    {
        $text = $kode . " adalah kode untuk mengaktifkan akun SIPESAT.";
        Http::post('https://api.visimediatech.com/wa/' . 'send-text', [
            'api_key' => 'cb4cceb7fa7b79ed9931eadacda364bf',
            'number' => trim($no_hp),
            'message' => $text
        ]);
    }
}
