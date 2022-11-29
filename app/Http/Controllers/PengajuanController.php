<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Pengajuan;
use App\Models\PerihalPengajuan;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::all();

        return view('pages.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        $time = Carbon::now();
        $tgl_pengajuan = $time->format('Y-m-d');

        return view('pages.pengajuan.create', compact('tgl_pengajuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_surat' => 'required|date',
            'tgl_pengajuan' => 'required|date',
            'keperluan' => 'required|array'
        ]);

        /**
         * Tahapan
         * 1. pengajuans (store)
         * 2. perihal_pengajuans (store)
         */

        //* Tahap 1
        $dataPengajuan = [
            'nik' => Auth::user()->nik,
            'tgl_surat' => $request->tgl_surat,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'status' => 0,
            'no_surat' => 0
        ];
        $pengajuan = Pengajuan::create($dataPengajuan);

        //* Tahap 2
        $totalPerihal = \count($request->keperluan);
        for ($i = 0; $i < $totalPerihal; $i++) {
            $dataPerihal = [
                'pengajuan_id' => $pengajuan->id,
                'perihal' => $request->keperluan[$i]
            ];

            PerihalPengajuan::create($dataPerihal);
        }

        return redirect()
            ->route('pengajuan')
            ->withSuccess('Data berhasil tersimpan.');
    }

    public function edit($id)
    {
        $data = Pengajuan::find($id);
        $perihals = PerihalPengajuan::where('pengajuan_id', $id)->get();

        return view('pages.pengajuan.edit', compact(
            'data',
            'perihals'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_surat' => 'required|date',
            'tgl_pengajuan' => 'required|date',
            'keperluan' => 'required|array'
        ]);

        /**
         * Tahapan
         * 1. pengajuans (update)
         * 2. perihal_pengajuans (update)
         */

        //* Tahap 1
        $dataPengajuann = [
            'tgl_surat' => $request->tgl_surat,
            'tgl_pengajuan' => $request->tgl_pengajuan
        ];
        Pengajuan::where('id', $id)->update($dataPengajuann);

        //* Tahap 2
        PerihalPengajuan::where('pengajuan_id', $id)->delete();

        $totalPerihal = \count($request->keperluan);
        for ($i = 0; $i < $totalPerihal; $i++) {
            $dataPerihal = [
                'pengajuan_id' => $id,
                'perihal' => $request->keperluan[$i]
            ];
            PerihalPengajuan::create($dataPerihal);
        }

        return redirect()
            ->route('pengajuan.edit', $id)
            ->withSuccess('Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pengajuan::destroy($id);
        PerihalPengajuan::where('pengajuan_id', $id)->delete();

        return response()->json(['message' => "Data berhasil dihapus."]);
    }

    public function destroyPerihal($pengajuan_id, $perihal_id)
    {
        $perihal = PerihalPengajuan::where('pengajuan_id', $pengajuan_id)->count();
        if ($perihal == 1) {
            return redirect()
                ->route('pengajuan.edit', $pengajuan_id)
                ->withErrors('Harus terdapat minimal 1 perihal.');
        } else {
            PerihalPengajuan::destroy($perihal_id);
        }

        return redirect()
            ->route('pengajuan.edit', $pengajuan_id)
            ->withSuccess('Data berhasil diperbarui.');
    }

    public function cetak($id)
    {
        $data = Pengajuan::find($id);

         // QR Code RT
         $file_url = route('validasiRT', $id);
         $b   = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->merge(public_path('images/logo-png.png'), 0.2, true)->size(900)->errorCorrection('H')->margin(0)->generate($file_url));
         $qrRT = '<img width="60" height="61" src="data:image/png;base64, ' . $b . '" alt="qr code" />';
 
         // QR Code RW
         $file_url = route('validasiRW', $id);
         $b   = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->merge(public_path('images/logo-png.png'), 0.2, true)->size(900)->errorCorrection('H')->margin(0)->generate($file_url));
         $qrRW = '<img width="60" height="61" src="data:image/png;base64, ' . $b . '" alt="qr code" />';

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('legal', 'portrait');
        $pdf->loadView('pages.pengajuan.surat', compact(
            'data',
            'qrRT',
            'qrRW'
        ));

        return $pdf->stream($data->anggota->nama . ' ( ' . $data->tgl_pengajuan . ' ) ' . ".pdf");
    }

    public function kirimSurat($id)
    {
        $data = Pengajuan::find($id);
        $data->update([
            'status' => 1
        ]);

        return redirect()
            ->route('pengajuan')
            ->withSuccess('Surat berhasil dikirim, Tunggu hingga pemberitahuan selanjutnya.');
    }
}
