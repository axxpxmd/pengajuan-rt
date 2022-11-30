@extends('layouts.app')
@section('title', '| Pengajuan')
@section('content')
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
        @include('layouts.alert')
        <div class="row justify-content-md-center" data-aos="fade-up" data-aos-delay="300">
            <div class="col-md-12 m-b-190">
                <div class="mb-3 text-right">
                    <a href="{{ route('pengajuan.create') }}" class="btn btn-sm btn-success px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table data-table display nowrap table-hover table-bordered fs-14" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10%" class="text-center">No</th>
                                <th width="30%">No Surat</th>
                                <th width="20%">Tanggal Pengajuan</th>
                                <th width="10%">Status</th>
                                <th width="10%">Jumlah Perihal</th>
                                <th width="10%">Cetak</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuans as $key => $i)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>{{ $i->no_surat }}</td>
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_pengajuan)->format('d F Y') }}</td>
                                    <td class="text-center">
                                        @include('pages.pengajuan.status')
                                    </td>
                                    <td class="text-center">{{ $i->perihal->count() }} Perihal</td>
                                    <td class="text-center">
                                        <a href="{{ route('pengajuan.cetak', $i->id) }}" target="_blank" class="text-primary1 fs-16"><i class="bi bi-printer"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if ($i->status == 0 || $i->status == 2 || $i->status == 5)
                                            <a href="{{ route('pengajuan.kirimSurat', $i->id) }}" class="text-success1 fs-16 m-r-15" title="Kirim Surat"><i class="bi bi-arrow-right-circle-fill"></i></a>
                                            <a href="{{ route('pengajuan.edit', $i->id) }}" class="text-warning fs-16 m-r-15" title="Edit Surat"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" onclick="remove({{ $i->id }})" class="text-danger fs-16" title="Hapus Surat"><i class="bi bi-trash-fill"></i></a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true
        });
    });

    function remove(id){
        $.confirm({
            title: 'Konfirmasi',
            content: 'Apakah anda yakin ingin menghapus data ini ?',
            icon: 'bi bi-question text-danger',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        $.post("{{ route('pengajuan.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
                            success(data.message);
                        }, "JSON").fail(function(){
                            reload();
                        });
                    }
                },
                cancel: function(){}
            }
        });
    }
</script>
@endsection
