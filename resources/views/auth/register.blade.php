@extends('layouts.app')
@section('title', '| Register')
@section('content')
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
<section class="align-items-center">
    <div class="container">
        <div class="row justify-content-md-center" data-aos="fade-up" data-aos-delay="300">
            <div class="col-md-4">
                <img class="img-fluid" src="{{ asset('images/auth/register.png') }}" alt="login">
            </div>  
            <div class="col-md-4">
                <p class="font-weight-bold mb-0 fs-22">Register SIPESAT</p>
                <span class="fs-13">Masukan NIK 16 Digit.</span>
                @if ($errors->has('nik'))
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show mt-2" id="errorAlert" role="alert">
                    <i class="bi bi-exclamation-circle-fill mr-2"></i>
                    <div class="fs-13">
                        {{ $errors->first('nik') }}
                    </div>
                    <button class="btn-close fs-20" data-bs-dismiss="alert" style="border: none;background: none;padding-top: 14px"><i class="bi bi-x"></i></button>
                </div>
                @endif
                <form class="needs-validation mt-3" novalidate method="POST" action="{{ route('register.checkNIK') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="number" class="form-control fs-15 @if ($errors->has('nik')) is-invalid @endif" name="nik" value="{{ old('nik') }}" placeholder="NIK" autocomplete="off" autofocus required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fs-15" data-toggle="modal" data-target="#loading"><i class="bi bi-arrow-right m-r-5"></i>Selanjutnya</button>
                    </div>
                </form>
                <hr class="mt-4">
                <p class="fs-14">Sudah punya akun ?<a href="{{ route('login') }}" class="ml-2">Login</a></p>
            </div>
        </div>
    </div>
</section>
@include('layouts.loading')
@endsection
