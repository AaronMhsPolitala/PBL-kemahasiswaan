@extends('layouts.user')

@section('title', 'Pendaftaran Pengurus HIMA TI')

@push('styles')
<!-- Pastikan link bootstrap ada di head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Modern CSS for Pendaftaran Page */

    /* Import Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f0f2f5;
    }

    .pendaftaran-card {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        margin: 50px auto;
    }

    .pendaftaran-header {
        background-color: #0d6efd;
        color: #ffffff;
        padding: 40px;
        text-align: center;
    }

    .pendaftaran-header h4 {
        font-weight: 700;
        font-size: 28px;
        margin: 0;
    }

    .pendaftaran-header p {
        font-size: 16px;
        opacity: 0.9;
        margin-top: 10px;
    }

    .pendaftaran-body {
        padding: 40px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 12px 20px;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.25);
        background-color: #fff;
    }

    .btn-submit-pendaftaran {
        background-color: #0d6efd;
        color: #ffffff;
        font-weight: 600;
        border-radius: 50px;
        padding: 12px 30px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
    }

    .btn-submit-pendaftaran:hover {
        background-color: #0b5ed7;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.6);
    }

    @media (max-width: 768px) {
        .pendaftaran-body {
            padding: 30px;
        }
        .pendaftaran-header {
            padding: 30px;
        }
    }
</style>
@endpush

@section('content')
<div class="pendaftaran-card">
    <div class="pendaftaran-header">
        <h4>Formulir Pendaftaran Pengurus HIMA TI</h4>
        <p>Silakan isi form berikut untuk mendaftar sebagai pengurus HIMA TI.</p>
    </div>
    <div class="pendaftaran-body">
        <form action="{{ route('user.pendaftaran.store') }}" method="POST">
            @csrf
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" id="nim" name="nim" class="form-control" placeholder="Masukkan NIM" required>
                </div>
                <div class="col-md-6">
                    <label for="hp" class="form-label">Nomor HP</label>
                    <input type="text" id="hp" name="hp" class="form-control" placeholder="Masukkan nomor aktif" required>
                </div>
                <div class="col-md-6">
                    <label for="divisi" class="form-label">Divisi Tujuan</label>
                    <select id="divisi" name="divisi" class="form-select" required>
                        <option selected disabled value="">Pilih Divisi...</option>
                        <option value="kaderisasi">Kaderisasi</option>
                        <option value="media_informasi">Media Informasi</option>
                        <option value="technopreneurship">Technopreneurship</option>
                        <option value="public_relation">Public Relation</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="alasan" class="form-label">Alasan Bergabung</label>
                    <textarea id="alasan" name="alasan" class="form-control" rows="4" placeholder="Ceritakan alasan Anda bergabung" required></textarea>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-submit-pendaftaran">
                    <i class="fa-solid fa-user-plus me-2"></i> Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection