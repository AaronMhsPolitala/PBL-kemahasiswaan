@extends('layouts.user')

@section('title','Kotak Aspirasi')

@section('content')
    <div class="form-container">
        <div class="form-header">
            <h1>Kotak Aspirasi</h1>
            <p>Sampaikan aspirasi, kritik, dan saran Anda untuk HMTI yang lebih baik.</p>
        </div>
                @if(session('ok'))
            <div class="alert alert-success" style="padding:10px 12px;border-radius:8px;background:#ecfdf5;color:#065f46;margin-bottom:12px;">
                {{ session('ok') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="padding:10px 12px;border-radius:8px;background:#fef2f2;color:#991b1b;margin-bottom:12px;">
                <strong>Oops! Ada beberapa masalah dengan input Anda:</strong><br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.aspirasi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda">
            </div>
            <div class="form-group">
                <label for="perihal">Perihal</label>
                <input type="text" id="perihal" name="perihal" placeholder="Subjek atau topik aspirasi Anda">
            </div>
            <div class="form-group">
                <label for="aspirasi">Aspirasi Anda</label>
                <textarea id="aspirasi" name="pesan" placeholder="Tuliskan aspirasi, kritik, atau saran Anda di sini..."></textarea>
            </div>
            <button type="submit" class="submit-btn">Kirim Aspirasi</button>
        </form>
    </div>
@endsection