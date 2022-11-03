@extends('layouts.app')
@section('title', '| Register')
@section('content')
@php
    $ya = '<span class="badge bg-success">Ya</span>';
    $tidak = '<span class="badge bg-danger">Tidak</span>';
@endphp
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h5>Halaman Register</h5>
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Register</li>
            </ol>
        </div>
    </div>
</section>
<section class="align-items-center pt-3" data-aos="fade-up" data-aos-delay="300">
    <div class="container col-md-12">
        <div class="card">
            <h5 class="card-header bg-info text-white fs-16 px-3 py-3 fw-bold">Verifikasi Data</h5>
            <div class="card-body fs-14">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Kecamatan</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->rtrw->kecamatan->n_kecamatan }}</label>
                        </div> 
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Kelurahan</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->rtrw->kelurahan->n_kelurahan }}</label>
                        </div> 
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">RT / RW</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->rtrw->rt }} / {{ $anggota->rtrw->rw }}</label>
                        </div> 
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Dasawisma</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->rumah->dasawisma ? $anggota->rumah->dasawisma->nama : '-' }}</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Rumah</label>
                            <label class="col-sm-8 col-form-label">
                                {{ $anggota->rumah->kepala_rumah }} ( {{ $anggota->rumah->alamat_detail }} )
                            </label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Terdaftar Dukcapil</label>
                            <label class="col-sm-8 col-form-label">
                                @if ($anggota->anggotaDetail->terdaftar_dukcapil == 1)
                                    {!! $ya !!}
                                @else
                                    {!! $tidak !!}
                                @endif
                            </label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">NIK</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->nik }} / {{ $anggota->anggotaDetail->domisili == 1 ? 'Tangerang Selatan' : 'Luar Tangsel' }}</label>
                        </div>
                        @if ($anggota->anggotaDetail->domisili == 0)
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Alamat Luar Tangsel</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->anggotaDetail->almt_luar_tangsel }}</label>
                        </div>
                        @endif
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">No KK</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->no_kk }} ( {{ $anggota->kk ? $anggota->kk->nm_kpl_klrga : '' }} )</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Nama Lengkap</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->nama }}</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Jenis Kelamin</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->kelamin }}</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Tempat Lahir</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->tmpt_lahir }}</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Tanggal Lahir</label>
                            <label class="col-sm-8 col-form-label">{{ Carbon\Carbon::createFromFormat('Y-m-d', $anggota->tgl_lahir)->format('d F Y') }} / <span id="umur"></span></label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Akte Kelahiran</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->akta_kelahiran }}</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Status Perkawinan</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->status_kawin }}</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Agama</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->agama }}</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Pendidikan</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->status_pendidkan == 1 ? 'Tamat Sekolah' : 'Putus Sekolah' }} ( {{ $anggota->pendidikan }}) </label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Pekerjaan</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->pekerjaan }}</label>
                        </div>
                        <div class="row p-0">
                            <label class="col-sm-4 col-form-label fw-bold">Jabatan</label>
                            <label class="col-sm-8 col-form-label">{{ $anggota->jabatan }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 container">
        <div class="card mt-4">
            <div class="card-body">
                <div class="alert alert-warning fs-14" role="alert">
                    Silahkan Masukan NO HP aktif (Whatsaap) untuk menerima kode OTP    
                </div>
                <form class="needs-validation fs-14" novalidate method="POST" action="{{ route('register.sendOTP', $nik) }}">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                        <input type="number" class="form-control fs-15 @if ($errors->has('no_hp')) is-invalid @endif" name="no_hp" placeholder="No HP (Whatsapp)" autocomplete="off" autofocus required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fs-15"><i class="bi bi-arrow-right m-r-5"></i>Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('layouts.loading')
@endsection
@push('script')
<script type="text/javascript">
    // get Umur
    var tgl_lahir = new Date("{{ $anggota->tgl_lahir }}");  
    var diff_ms = Date.now() - tgl_lahir.getTime();
    var age_dt = new Date(diff_ms); 
    var age = Math.abs(age_dt.getUTCFullYear() - 1970);
    var ageResult = isNaN(age) === false ? age + ' Tahun' : '. . .' 
    $('#umur').html('Umur : ' + ageResult);
</script>
@endpush
