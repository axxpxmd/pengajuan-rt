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
    @if ($data->password == null)
    <div class="col-md-4 container">
        @include('layouts.alert')
        <div class="alert alert-warning fs-14 text-center" role="alert">
            <p class="m-0">Kode OTP telah dikirimkan ke nomor <b>{{ $no_hp }}</b> (Whatsapp)</p>
            <div class="row justify-content-center mt-2">
                <div class="col-sm-auto">
                    <a href="{{ route('register.resendOTP', ['nik' => $nik, 'no_hp' => $no_hp]) }}">Kirim Ulang ?</a>  
                </div>
                <div class="col-sm-auto">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Ganti Nomor</a> 
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <form class="needs-validation fs-14" novalidate method="POST" action="{{ route('register.create') }}">
                    @csrf
                    <input type="hidden" name="no_hp" value="{{ $no_hp }}">
                    <input type="hidden" name="nik" value="{{ $nik }}">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-shield-fill-check"></i></span>
                        <input type="number" class="form-control fs-15 @if ($errors->has('no_hp')) is-invalid @endif" name="kode" placeholder="Kode OTP" autocomplete="off" autofocus required>
                    </div>
                    <p style="background: #F1F1F1" class="p-2 rounded fs-14 text-black">Buat Password</p>
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" class="form-control fs-15 @if ($errors->has('password')) is-invalid @endif" name="password" id="password" placeholder="Password" autocomplete="off" required>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" class="form-control fs-15 @if ($errors->has('confirm_password')) is-invalid @endif" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" autocomplete="off" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fs-15"><i class="bi bi-arrow-right m-r-5"></i>Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <img class="img-fluid" src="{{ asset('images/auth/login.png') }}" alt="login">
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card bg-light m-b-100 m-t-49">
                    <div class="card-body">
                        <div class="fs-14 text-center">
                            <p>Selamat, Akun anda sudah aktif. Silahkan <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary1">
                <p class="modal-title text-white fs-16 fw-bold" id="exampleModalLabel">Ganti Nomor</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation fs-14" novalidate method="POST" action="{{ route('register.changeNoHP', $nik) }}">
                    @csrf
                    <input type="hidden" name="nik" value="{{ $nik }}">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                        <input type="number" class="form-control fs-15 @if ($errors->has('no_hp')) is-invalid @endif" name="no_hp" placeholder="No HP (Whatsapp)" autocomplete="off" autofocus required>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success btn-block btn-lg fs-14"><i class="bi bi-arrow-right m-r-5"></i>Ganti</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-danger btn-block fs-14" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x m-r-5"></i>Batalkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@include('layouts.loading')
@endsection
@push('script')
<script type="text/javascript">
    // 
</script>
@endpush
