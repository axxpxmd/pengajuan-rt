<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        $anggota = Anggota::where('nik', $data->nik)->first();

        return view('pages.profile.index', compact(
            'data',
            'anggota'
        ));
    }
}
