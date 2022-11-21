@if ($i->status == 0)
    <span>Surat Belum dikirim</span>
@endif
@if ($i->status == 1)
    <span>Dicek oleh RT</span>
@endif
@if ($i->status == 2)
    <span>Ditolak / Dikembalikan oleh RT</span>
@endif
@if ($i->status == 3)
    <span>Disetujui oleh RT</span>
@endif
@if ($i->status == 4)
    <span>Dicek oleh RW</span>
@endif
@if ($i->status == 5)
    <span>Ditolak / Dikembalikan oleh RW</span>
@endif
@if ($i->status == 6)
    <span>Surat Disetujui</span>
@endif