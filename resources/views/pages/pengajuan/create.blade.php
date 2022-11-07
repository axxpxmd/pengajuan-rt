@extends('layouts.app')
@section('title', '| Pengajuan')
@section('content')
@php
    $ya = '<span class="badge bg-success">Ya</span>';
    $tidak = '<span class="badge bg-danger">Tidak</span>';
@endphp
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h5>Halaman Pengajuan</h5>
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Profile</li>
            </ol>
        </div>
    </div>
</section>
<section class="align-items-center">
    <div class="container">
        <div class="row justify-content-md-center" data-aos="fade-up" data-aos-delay="300">
            <div class="col-md-8 m-b-190">
                @include('layouts.alert')
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white fs-16 fw-bold">Tambah Data</div>
                    <div class="card-body">
                        <a href="{{ route('pengajuan') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
                        <form action="{{ route('pengajuan.store') }}" class="needs-validation fs-14" method="POST" enctype="multipart/form-data" novalidate>
                            {{ method_field('POST') }}
                            @csrf
                            <div class="row mb-2">
                                <label for="tgl_surat" class="col-sm-4 col-form-label text-end fw-bold">Tanggal Surat <span class="text-danger"> *</span></label>
                                <div class="col-sm-7">
                                    <input type="date" name="tgl_surat" id="tgl_surat" class="form-control fs-14" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="tgl_pengajuan" class="col-sm-4 col-form-label text-end fw-bold">Tanggal Pengajuan <span class="text-danger"> *</span></label>
                                <div class="col-sm-7">
                                    <input type="date" name="tgl_pengajuan" id="tgl_pengajuan" class="form-control fs-14" value="{{ $tgl_pengajuan }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div id="keperluan">
                                <div class="row mb-2">
                                    <label for="keperluan" class="col-sm-4 col-form-label text-end fw-bold">Perihal <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <textarea type="text" name="keperluan[]" id="keperluan" placeholder="Perihal yang disampaikan" class="form-control fs-14" autocomplete="off" required></textarea>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-sm btn-primary m-t-12" id="add-pengajuan"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-success fs-14" title="Simpan Data"><i class="bi bi-save m-r-8"></i>Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $("#add-pengajuan").click(function () {
        $("#keperluan").append(
            `
            <div class="tambahan row mb-2">
                <label for="keperluan" class="col-sm-4 col-form-label text-end fw-bold"></label>
                <div class="col-sm-7">
                    <textarea type="text" name="keperluan[]" id="keperluan" placeholder="Perihal yang disampaikan" class="form-control fs-14" autocomplete="off" required></textarea>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-danger remove-input-field m-t-12"><i class="bi bi-trash-fill"></i></button>
                </div>
            </div>
            `
        );
    });

    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('.tambahan').remove();
    });

</script>
@endsection
