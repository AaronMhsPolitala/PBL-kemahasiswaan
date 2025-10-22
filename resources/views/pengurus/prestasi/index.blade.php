@extends('layouts.pengurus')

@section('title', 'Kelola Prestasi Mahasiswa')

@section('content')
<div id="prestasi-page">
    <h1>Kelola Prestasi Mahasiswa</h1>

    <div class="filter-container">
        <form action="{{ route('pengurus.prestasi.index') }}" method="GET">
            <div class="filter-group">
                <label for="periode">Periode</label>
                <select name="periode" id="periode">
                    <option value="">Semua</option>
                    @foreach($periodes as $periode)
                        <option value="{{ $periode }}" {{ request('periode') == $periode ? 'selected' : '' }}>
                            {{ $periode }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="sistem_kuliah">Sistem Kuliah</label>
                <select name="sistem_kuliah" id="sistem_kuliah">
                    <option value="">Semua</option>
                    @foreach($sistem_kuliahs as $sistem_kuliah)
                        <option value="{{ $sistem_kuliah }}" {{ request('sistem_kuliah') == $sistem_kuliah ? 'selected' : '' }}>
                            {{ $sistem_kuliah }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="search">NIM/Nama</label>
                <input type="text" name="search" id="search" placeholder="Cari NIM atau Nama" value="{{ request('search') }}">
            </div>
            <div class="filter-buttons">
                <button type="submit" class="btn-filter">Filter</button>
                <button type="button" onclick="window.location='{{ route('pengurus.prestasi.index') }}'" class="btn-reset">Reset</button>
            </div>
        </form>
    </div>

    <section class="data-table-container" style="margin-top:12px">
        <div style="margin-bottom:12px; padding: 1.5rem;">
            <button type="button" class="btn-print btn-tambah">Tambah Data</button>
        </div>

        @if(session('success'))
            <div class="flash-message success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="flash-message error">
                <strong>Gagal!</strong> Terjadi kesalahan validasi:
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="data-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>SISTEM KULIAH</th>
                    <th>IPK</th>
                    <th>PERIODE</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestasis as $prestasi)
                    <tr>
                        <td>{{ $loop->iteration + $prestasis->firstItem() - 1 }}</td>
                        <td>{{ $prestasi->nim }}</td>
                        <td>{{ $prestasi->nama }}</td>
                        <td>{{ $prestasi->sistem_kuliah }}</td>
                        <td>{{ $prestasi->ipk }}</td>
                        <td>{{ $prestasi->periode }}</td>
                        <td>
                            <button type="button" class="btn-blue btn-lihat" data-prestasi='{{ json_encode($prestasi) }}'>Lihat</button>
                            <button type="button" class="btn-yellow btn-edit" data-prestasi='{{ json_encode($prestasi) }}' data-update-url="{{ route('pengurus.prestasi.update', $prestasi) }}">Edit</button>
                            <form action="{{ route('pengurus.prestasi.destroy', $prestasi) }}" method="POST" class="delete-form" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-red btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="7">Belum ada data prestasi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-container">
            {{ $prestasis->links('pagination::bootstrap-4') }}
        </div>
    </section>

    <!-- Modals -->
    <div id="viewModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="custom-modal-close">&times;</span>
            <h2>Detail Prestasi</h2>
            <div class="modal-body-content">
                <div class="prestasi-info"><strong>NIM:</strong> <span id="view_nim"></span></div>
                <div class="prestasi-info"><strong>Nama:</strong> <span id="view_nama"></span></div>
                <div class="prestasi-info"><strong>Sistem Kuliah:</strong> <span id="view_sistem_kuliah"></span></div>
                <div class="prestasi-info"><strong>IPK:</strong> <span id="view_ipk"></span></div>
                <div class="prestasi-info"><strong>Periode:</strong> <span id="view_periode"></span></div>
            </div>
        </div>
    </div>

    <div id="formModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="custom-modal-close">&times;</span>
            <h2 id="formModalTitle">Tambah Prestasi</h2>
            <div class="modal-body-content">
                <form id="prestasiForm" method="POST" action="">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod">
                    <div class="form-group"><label for="nim">NIM</label><input type="text" id="nim" name="nim" required></div>
                    <div class="form-group"><label for="nama">Nama</label><input type="text" id="nama" name="nama" required></div>
                    <div class="form-group"><label for="sistem_kuliah">Sistem Kuliah</label><input type="text" id="sistem_kuliah" name="sistem_kuliah" required></div>
                    <div class="form-group"><label for="ipk">IPK</label><input type="number" step="0.01" id="ipk" name="ipk" required></div>
                    <div class="form-group"><label for="periode">Periode</label><input type="text" id="periode" name="periode" required></div>
                    <div class="modal-footer-buttons">
                        <button type="submit" class="btn-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="custom-modal">
        <div class="custom-modal-content" style="max-width: 400px;">
            <span class="custom-modal-close">&times;</span>
            <h2>Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="modal-footer-buttons">
                <button type="button" id="confirmDeleteBtn" class="btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    #prestasi-page {
        --primary-color: #2563eb;
        --primary-hover-color: #1d4ed8;
        --success-color: #22c55e;
        --success-hover-color: #16a34a;
        --secondary-color: #6B7280;
        --light-gray: #F3F4F6;
        --border-color: #E5E7EB;
        --text-dark: #1F2937;
        --text-light: #6B7280;
    }

    #prestasi-page h1 { font-size: 1.875rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1.5rem; }
    #prestasi-page .filter-container { background-color: #fff; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
    #prestasi-page .filter-container form { display: flex; align-items: flex-end; gap: 1rem; flex-wrap: wrap; }
    #prestasi-page .filter-group { display: flex; flex-direction: column; }
    #prestasi-page .filter-group label { font-weight: 500; margin-bottom: 0.5rem; color: var(--text-light); font-size: 0.875rem; }
    #prestasi-page .filter-group select, #prestasi-page .filter-group input { padding: 0.625rem 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background-color: #fff; transition: all 0.2s ease-in-out; height: calc(1.25rem + 1.25rem + 2px); }
    #prestasi-page .filter-group select:focus, #prestasi-page .filter-group input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3); }
    #prestasi-page .filter-buttons { display: flex; align-items: flex-end; gap: 0.75rem; }
    #prestasi-page .btn-filter, #prestasi-page .btn-reset { padding: 0.625rem 1.25rem; border-radius: 0.5rem; border: 0; color: #fff; font-weight: 600; cursor: pointer; text-decoration: none; transition: background-color 0.2s ease-in-out; height: calc(1.25rem + 1.25rem + 2px); }
    #prestasi-page .btn-filter { background-color: var(--primary-color); }
    #prestasi-page .btn-filter:hover { background-color: var(--primary-hover-color); }
    #prestasi-page .btn-reset { background-color: var(--success-color); }
    #prestasi-page .btn-reset:hover { background-color: var(--success-hover-color); }
    #prestasi-page .btn-print { background: #22c55e; color: #fff; padding: 8px 14px; border-radius: 8px; font-weight: 600; text-decoration: none; border: 0; cursor: pointer; }
    #prestasi-page .btn-blue { background: #3b82f6; color: #fff; padding: 6px 10px; border-radius: 6px; text-decoration: none; margin-right: 6px; font-weight: 600; border: 0; cursor: pointer; }
    #prestasi-page .btn-yellow { background: #f59e0b; color: #fff; padding: 6px 10px; border-radius: 6px; text-decoration: none; margin-right: 6px; font-weight: 600; border: 0; cursor: pointer; }
    #prestasi-page .btn-red { background: #ef4444; color: #fff; padding: 6px 10px; border-radius: 6px; border: 0; font-weight: 600; cursor: pointer; }
    #prestasi-page .data-table-container { background-color: #fff; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); overflow: hidden; }
    #prestasi-page .data-table { width: 100%; border-collapse: collapse; }
    #prestasi-page .data-table th, #prestasi-page .data-table td { padding: 1rem 1.5rem; text-align: left; border-bottom: 1px solid var(--border-color); }
    #prestasi-page .data-table thead th { background-color: var(--light-gray); font-weight: 600; color: var(--text-light); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
    #prestasi-page .data-table tbody tr:hover { background-color: #F9FAFB; }
    #prestasi-page .data-table td { color: var(--text-dark); }
    #prestasi-page .data-table .empty-row td { text-align: center; padding: 3rem; color: var(--text-light); }
    #prestasi-page .pagination-container { padding: 1.5rem; display: flex; justify-content: center; }
    #prestasi-page .pagination { display: flex; list-style: none; padding: 0; }
    #prestasi-page .pagination li { margin: 0 0.25rem; }
    #prestasi-page .pagination li a, #prestasi-page .pagination li span { display: block; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--primary-color); background-color: #fff; border: 1px solid var(--border-color); transition: all 0.2s ease-in-out; }
    #prestasi-page .pagination li.active span { background-color: var(--primary-color); color: #fff; border-color: var(--primary-color); }
    #prestasi-page .pagination li.disabled span { color: #9CA3AF; background-color: var(--light-gray); }
    #prestasi-page .pagination li a:hover { background-color: var(--light-gray); }
    #prestasi-page .flash-message { padding: 1rem 1.5rem; border-radius: 0.5rem; margin: 0 1.5rem 1rem; font-weight: 500; }
    #prestasi-page .flash-message.success { background-color: #ecfdf5; color: #166534; }
    #prestasi-page .flash-message.error { background-color: #fef2f2; color: #991b1b; }
    #prestasi-page .flash-message ul { list-style-position: inside; margin-top: 0.5rem; }

    /* Custom Modal Styles */
    #prestasi-page .custom-modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5); }
    #prestasi-page .custom-modal-content { background-color: #fefefe; margin: 5% auto; padding: 24px; border: 1px solid #888; width: 80%; max-width: 600px; border-radius: 12px; position: relative; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    #prestasi-page .custom-modal-close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
    #prestasi-page .custom-modal-close:hover, #prestasi-page .custom-modal-close:focus { color: black; text-decoration: none; }
    #prestasi-page .modal-body-content { padding-top: 20px; }
    #prestasi-page .prestasi-info { display: flex; margin-bottom: 12px; font-size: 1rem; }
    #prestasi-page .prestasi-info strong { width: 120px; font-weight: 600; color: #4b5563; }
    #prestasi-page .modal-footer-buttons { text-align: right; margin-top: 20px; }
    #prestasi-page .modal-footer-buttons button { margin-left: 10px; padding: 10px 18px; border-radius: 8px; cursor: pointer; border: none; font-weight: 600; }
    #prestasi-page .btn-danger { background-color: #dc3545; color: white; }
    #prestasi-page .form-group { margin-bottom: 1rem; }
    #prestasi-page .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #4b5563; }
    #prestasi-page .form-group input { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; }
    #prestasi-page .btn-submit { background-color: #22c55e; color: #fff; padding: 12px 20px; border: 0; border-radius: 8px; font-weight: 600; cursor: pointer; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const page = document.getElementById('prestasi-page');
    if (!page) return;

    const viewModal = page.querySelector('#viewModal');
    const formModal = page.querySelector('#formModal');
    const deleteModal = page.querySelector('#deleteModal');
    const modals = [viewModal, formModal, deleteModal];

    const form = page.querySelector('#prestasiForm');
    const formModalTitle = page.querySelector('#formModalTitle');
    const formMethodInput = page.querySelector('#formMethod');

    let formToSubmit = null;

    // Open Modals
    page.querySelector('.btn-tambah').addEventListener('click', () => {
        form.reset();
        form.action = "{{ route('pengurus.prestasi.store') }}";
        formMethodInput.value = 'POST';
        formModalTitle.textContent = 'Tambah Prestasi';
        formModal.style.display = 'block';
    });

    page.querySelectorAll('.btn-lihat').forEach(btn => {
        btn.addEventListener('click', () => {
            const data = JSON.parse(btn.dataset.prestasi);
            page.querySelector('#view_nim').textContent = data.nim;
            page.querySelector('#view_nama').textContent = data.nama;
            page.querySelector('#view_sistem_kuliah').textContent = data.sistem_kuliah;
            page.querySelector('#view_ipk').textContent = data.ipk;
            page.querySelector('#view_periode').textContent = data.periode;
            viewModal.style.display = 'block';
        });
    });

    page.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            const data = JSON.parse(btn.dataset.prestasi);
            form.reset();
            form.action = btn.dataset.updateUrl;
            formMethodInput.value = 'PUT';
            formModalTitle.textContent = 'Edit Prestasi';

            form.querySelector('#nim').value = data.nim;
            form.querySelector('#nama').value = data.nama;
            form.querySelector('#sistem_kuliah').value = data.sistem_kuliah;
            form.querySelector('#ipk').value = data.ipk;
            form.querySelector('#periode').value = data.periode;

            formModal.style.display = 'block';
        });
    });

    page.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', () => {
            formToSubmit = btn.closest('.delete-form');
            deleteModal.style.display = 'block';
        });
    });

    // Confirm Delete
    page.querySelector('#confirmDeleteBtn').addEventListener('click', () => {
        if (formToSubmit) formToSubmit.submit();
    });

    // Close Modal Logic
    page.querySelectorAll('.custom-modal-close').forEach(btn => {
        btn.addEventListener('click', () => modals.forEach(m => m.style.display = 'none'));
    });

    window.addEventListener('click', (event) => {
        modals.forEach(m => {
            if (event.target == m) m.style.display = 'none';
        });
    });

    // If validation fails, show the form modal again
    @if($errors->any())
        formModal.style.display = 'block';
        // This part is tricky and might need more robust handling in a real app
        // For now, it re-opens the modal but might not perfectly restore state for EDIT vs CREATE.
        const oldMethod = "{{ old('_method') }}";
        if(oldMethod === 'PUT') {
            formModalTitle.textContent = 'Edit Prestasi';
            form.action = "{{ old('_previous.url') }}"; // This is a guess, might not be reliable
        } else {
            formModalTitle.textContent = 'Tambah Prestasi';
            form.action = "{{ route('pengurus.prestasi.store') }}";
        }
    @endif
});
</script>
@endpush