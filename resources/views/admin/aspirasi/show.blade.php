@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')
    <div class="aspirasi-card">
        <div class="card-header">
            <h1 class="card-title">Detail Aspirasi</h1>
        </div>
        <div class="card-body">
            <div class="aspirasi-info">
                <strong class="info-label">Dari:</strong>
                <span class="info-value">{{ $aspirasi->nama }}</span>
            </div>
            <div class="aspirasi-info">
                <strong class="info-label">Email:</strong>
                <span class="info-value"><a href="mailto:{{ $aspirasi->email }}">{{ $aspirasi->email }}</a></span>
            </div>
            <div class="aspirasi-info">
                <strong class="info-label">Waktu:</strong>
                <span class="info-value">{{ $aspirasi->created_at->format('d F Y, H:i') }}</span>
            </div>
            <hr class="aspirasi-divider">
            <div class="aspirasi-pesan">
                <strong class="info-label">Isi Pesan:</strong>
                <p>{{ nl2br(e($aspirasi->pesan)) }}</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.aspirasi.index') }}" class="btn-back">Kembali ke Daftar</a>
        </div>
    </div>
@endsection

@push('styles')
<style>
.aspirasi-card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    margin-top: 20px;
    overflow: hidden;
}
.aspirasi-card .card-header {
    padding: 20px 24px;
    background-color: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}
.aspirasi-card .card-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
}
.aspirasi-card .card-body {
    padding: 24px;
}
.aspirasi-card .aspirasi-info {
    display: flex;
    margin-bottom: 12px;
}
.aspirasi-card .info-label {
    width: 80px;
    font-weight: 600;
    color: #4b5563;
}
.aspirasi-card .info-value {
    color: #1f2937;
}
.aspirasi-card .info-value a {
    color: #3b82f6;
    text-decoration: none;
}
.aspirasi-card .info-value a:hover {
    text-decoration: underline;
}
.aspirasi-card .aspirasi-divider {
    margin: 20px 0;
    border: 0;
    border-top: 1px solid #e5e7eb;
}
.aspirasi-card .aspirasi-pesan p {
    margin-top: 8px;
    line-height: 1.6;
    color: #374151;
}
.aspirasi-card .card-footer {
    padding: 16px 24px;
    background-color: #f9fafb;
    text-align: right;
    border-top: 1px solid #e5e7eb;
}
.aspirasi-card .btn-back {
    background-color: #6b7280;
    color: #fff;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.2s;
}
.aspirasi-card .btn-back:hover {
    background-color: #4b5563;
}
</style>
@endpush
