<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class sendOTP
{
    public static function sendOTP($kode, $no_hp)
    {
        $endpoint = config('app.wagateway_ipserver');
        $api_key  = config('app.wagateway_apikey');

        $text = $kode . " adalah kode untuk mengaktifkan akun SIPESAT.";
        Http::post($endpoint . 'send-text', [
            'api_key' => $api_key,
            'number' => trim($no_hp),
            'message' => $text
        ]);
    }
}
