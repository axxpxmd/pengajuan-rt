@if ($i->status == 0)
    <span class="badge bg-danger">Surat Belum dikirim</span>
@endif
@if ($i->status == 1)
    <span class="badge bg-warning">Sedang dicek oleh RT</span>
@endif
@if ($i->status == 2)
    <span class="badge bg-danger">Ditolak RT</span>
@endif
@if ($i->status == 3)
    <span class="badge bg-success">Sudah disetujui RT</span>
@endif
@if ($i->status == 4)
    <span class="badge bg-warning">Sedang dicek oleh RW</span>
@endif
@if ($i->status == 5)
    <span class="badge bg-danger">Ditolak RW</span>
@endif
@if ($i->status == 6)
    <span class="badge bg-success">Sudah disetujui RW</span>
@endif