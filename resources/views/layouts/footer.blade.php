<footer id="footer" class="m-t-150" style="position: {{ isset($fixed) == true ? 'fixed' : 'relative' }}">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-2">
                <p class="font-weight-bold fs-18">{{ config('app.daerah') }}</p>
                <p class="mb-1">Senin - Kamis 08:00 – 16:00 WIB</p>
                <p class="mt-0">Jumat 07:30 – 16:00 WIB</p>
                <p class="mb-0"><i class="bi bi-pin-map-fill text-primary1 mr-2"></i>Jl. Adi Sengkong Blok A No.8, Serua, Kec. Ciputat, Kota Tangerang Selatan, Banten 15414</p>
                <p class="mb-0"><i class="bi bi-telephone-fill text-primary1 mr-2"></i>-</p>
                <p class="mt-0"><i class="bi bi-envelope-fill text-primary1 mr-2"></i>-</p>
            </div>
            <div class="col-md-4 mb-2">
                <p class="font-weight-bold fs-18">Info Pengaduan</p>
                <p class="mb-0"><i class="bi bi-telephone-fill text-primary1 mr-2"></i>-</p>
                <p class="mt-0"><i class="bi bi-envelope-fill text-primary1 mr-2"></i>{{ config('app.mail_from') }}</p>
            </div>
            <div class="col-md-4 mb-2">
                <p class="font-weight-bold fs-18">Social media</p>
                <a href="" class="mr-2"><i class="bi bi-instagram"></i></a>
                <a href="" class="mr-2"><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-twitter"></i></a>
            </div>
        </div>
        <hr>
        <p class="text-center font-weight-bold mb-0">Hak Cipta © {{ date('Y') }} {{ config('app.daerah') }}</p>
    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
