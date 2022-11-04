@extends('layouts.app')
@section('title', '| Profile')
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
                <div class="card">
                    <div class="card-header bg-info text-white fs-16 fw-bold">Edit Data</div>
                    <div class="card-body">
                        <a href="{{ route('pengajuan') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
                        <form action="{{ route('pengajuan.update', $data->id) }}" class="needs-validation fs-14" method="POST" enctype="multipart/form-data" novalidate>
                            {{ method_field('POST') }}
                            @csrf
                            <div class="row mb-2">
                                <label for="tgl_surat" class="col-sm-4 col-form-label text-end fw-bold">Tanggal Surat <span class="text-danger"> *</span></label>
                                <div class="col-sm-7">
                                    <input type="date" name="tgl_surat" id="tgl_surat" class="form-control fs-14" value="{{ $data->tgl_surat }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="tgl_pengajuan" class="col-sm-4 col-form-label text-end fw-bold">Tanggal Pengajuan <span class="text-danger"> *</span></label>
                                <div class="col-sm-7">
                                    <input type="date" name="tgl_pengajuan" id="tgl_pengajuan" class="form-control fs-14" value="{{ $data->tgl_pengajuan }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div id="keperluan">
                                @foreach ($perihals as $key => $i)
                                    <div class="row mb-2">
                                        <label for="keperluan" class="col-sm-4 col-form-label text-end fw-bold">
                                            @if($key == 0)
                                            Keperluan <span class="text-danger"> *</span>
                                            @endif
                                        </label>
                                        <div class="col-sm-7">
                                            <textarea type="text" name="keperluan[]" id="keperluan" placeholder="Perihan yang disampaikan" class="form-control fs-14" autocomplete="off" required>{{ $i->perihal }}</textarea>
                                        </div>
                                        @if($key == 0)
                                        <div class="col-sm-1">
                                            <button type="button" class="btn btn-sm btn-primary m-t-12" id="add-pengajuan"><i class="bi bi-plus"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-success fs-14" title="Perbarui Data"><i class="bi bi-save m-r-8"></i>Perbarui</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <p style="background: #E6EAEE" class="p-2 rounded fs-14 text-black fw-bold">Hapus Perihal</p>
                        <ol class="fs-14">
                            @foreach ($perihals as $i)
                                <li class="mt-1">{{ $i->perihal }} 
                                    <a href="{{ route('pengajuan.destroyPerihal', ['pengajuan_id'=>$data->id, 'perihal_id'=>$i->id]) }}" class="ml-2 text-danger"><i class="bi bi-trash-fill"></i></a>
                                </li>
                            @endforeach
                        </ol>
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
                    <textarea type="text" name="keperluan[]" id="keperluan" placeholder="Perihan yang disampaikan" class="form-control fs-14" autocomplete="off" required></textarea>
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
