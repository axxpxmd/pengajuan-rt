@extends('layouts.app')
@section('title', '| Profile')
@section('content')
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h5>Halaman Profile</h5>
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Profile</li>
            </ol>
        </div>
    </div>
</section>
<section class="align-items-center">
    <div class="container">
        @include('layouts.alert')
        <div class="row justify-content-md-center" data-aos="fade-up" data-aos-delay="300">
            <div class="col-md-12">
                <div class="text-center">
                    <img src="{{ asset('images/ava/default.png') }}" class="img-fluid rounded-circle mx-auto d-block mb-4" width="100" alt="">
                </div>
                <div class="text-center mt-2">
                    <p class="font-weight-bold fs-20">{{ $data->anggota->nama }} </p>
                </div>  
                <div class="card">
                    <h5 class="card-header bg-info text-white fs-16 px-3 py-3 fw-bold">Biodata</h5>
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
                                            Ya
                                        @else
                                            Tidak
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
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    // get Umur
    var tgl_lahir = new Date("{{ $anggota->tgl_lahir }}");  
    var diff_ms = Date.now() - tgl_lahir.getTime();
    var age_dt = new Date(diff_ms); 
    var age = Math.abs(age_dt.getUTCFullYear() - 1970);
    var ageResult = isNaN(age) === false ? age + ' Tahun' : '. . .' 
    $('#umur').html('Umur : ' + ageResult);
</script>
@endsection
