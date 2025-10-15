@extends('layouts.pengurus')

@section('title', 'Kelola Berita')

@section('content')
    <h1>Kelola Berita</h1>

    <section class="data-table-container" style="margin-top:12px">
        <div style="margin-bottom:12px;">
            <a href="{{ route('pengurus.berita.create') }}" class="btn-green">Tambah Berita</a>
        </div>

        @if(session('ok'))
            <div style="padding:10px 12px;border-radius:8px;background:#ecfdf5;color:#065f46;margin-bottom:12px;">
                {{ session('ok') }}
            </div>
        @endif

        <table class="data-table">
            <thead>
                <tr>
                    <th>FOTO</th>
                    <th>JUDUL</th>
                    <th>DESKRIPSI</th>
                    <th>WAKTU</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $berita)
                    <tr>
                        <td><img src="{{ asset('storage/' . $berita->foto_berita) }}" alt="Foto Berita" width="100"></td>
                        <td>{{ $berita->judul_berita }}</td>
                        <td style="max-width:320px">{{ Str::limit($berita->deskripsi, 60) }}</td>
                        <td>{{ $berita->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <div style="display: flex; gap: 6px;">
                                <a class="btn-blue" href="{{ route('pengurus.berita.show', $berita) }}">Lihat</a>
                                <a class="btn-yellow" href="{{ route('pengurus.berita.edit', $berita) }}">Edit</a>
                                <form action="{{ route('pengurus.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-red">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:#888;">Belum ada berita</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:12px;">
            {{ $beritas->links() }}
        </div>
    </section>
@endsection

@push('styles')
<style>
.btn-green{background:#22c55e;color:#fff;padding:8px 14px;border-radius:8px;font-weight:600;text-decoration:none}
.btn-blue{background:#3b82f6;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none;margin-right:6px;font-weight:600}
.btn-yellow{background:#eab308;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none;margin-right:6px;font-weight:600}
.btn-red{background:#ef4444;color:#fff;padding:6px 10px;border-radius:6px;border:0;font-weight:600;cursor:pointer}
.data-table{width:100%;border-collapse:collapse}
.data-table th,.data-table td{border:1px solid #e5e7eb;padding:8px 12px}
.data-table th{background:#f9fafb}
</style>
@endpush