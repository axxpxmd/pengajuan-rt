@extends('layouts.app')
@section('title', '| Home')
@section('content')
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">SIPESAT</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">
                    Sistem Informasi Pengajuan Surat RT {{ config('app.daerah') }}.
                </h2>
                <div data-aos="fade-up" data-aos-delay="800">
                    <a href="#tutorial" class="btn-get-started scrollto">Kirim Pengajuan</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>
</section>
<section id="tutorial" class="about">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>SIPESAT</h2>
        </div>
        <div class="row content">
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="150">
                <p class="text-justify lh-2-0">
                    SIPESAT - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                    enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                    dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class="mt-5">
            <h3 class="text-center font-weight-bold"  data-aos="fade-left" data-aos-delay="300">Cara Membuat Pengajuan</h3>
            <div class="row">
                <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
                    <img src="{{ asset('images/tutorial.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
                    <div class="content d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h4 class="font-weight-bold">1. Membuat Akun</h4>
                                <p>Anda dapat membuat akun terlebih dahulu di halaman ini. <a href="#" class="font-weight-bold">REGISTER</a></p>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h4 class="font-weight-bold">2. Aktivasi Akun</h4>
                                <p>Jika sudah mendaftar, Silahkan tunggu akun kamu diverifikasi. Cek Email secara berkala untuk pemberitahuan.</p>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h4 class="font-weight-bold">3. Membuat Pengajuan</h4>
                                <p>Membuat pengajuan/keperluan kepada RT/RW setempat.</p>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h4 class="font-weight-bold">4. Melihat historis Pengajuan</h4>
                                <p>Saat Anda telah membuat pengajuan, anda dapat melihat histori pengiriman surat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
