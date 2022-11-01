@extends('layouts.app')
@section('title', '| Login')
@section('content')

<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h5>Halaman Login</h5>
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Login</li>
            </ol>
        </div>
    </div>
</section>
<section class="align-items-center">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <img class="img-fluid" src="{{ asset('images/auth/login.png') }}" alt="login">
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="mt-4">
                    <p class="font-weight-bold mb-0 fs-22">Login SIPESAT</p>
                    <span class="fs-13">Masukan NIK dan Password</span>
                    @if ($errors->has('nik'))
                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show mt-2" id="errorAlert" role="alert">
                        <i class="bi bi-exclamation-circle-fill mr-2"></i>
                        <div class="fs-13">
                            {{ $errors->first('nik') }}
                        </div>
                        <button class="btn-close fs-20" data-bs-dismiss="alert" style="border: none;background: none;padding-top: 14px"><i class="bi bi-x"></i></button>
                    </div>
                    @endif
                    <form class="needs-validation mt-3" novalidate method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="number" class="form-control fs-15 @if ($errors->has('nik')) is-invalid @endif" name="nik" value="{{ old('nik') }}" placeholder="NIK" autocomplete="off" autofocus required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control fs-15 @if ($errors->has('password')) is-invalid @endif" name="password" id="password" placeholder="Password" autocomplete="off" required>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-6">
                                <input class="mr-2" type="checkbox" onclick="myFunction()"><span class="fs-14">Tampilkan</span>
                            </div>
                            <div class="col-6 text-right">
                                <span class="bx-pull-right fs-14"><a href="#">Lupa Password ?</a></span>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg fs-15"><i class="bi bi-arrow-right m-r-5"></i>Login</button>
                        </div>
                    </form>
                    <hr class="mt-4">
                    <p class="fs-14">Belum punya akun ?<a href="#" class="ml-2">Daftar sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $(document).ready(function() {
        $("#errorAlert").fadeTo(10000, 1000).slideUp(1000, function() {
            $("#errorAlert").slideUp(1000);
        });
    });
</script>
@endsection
