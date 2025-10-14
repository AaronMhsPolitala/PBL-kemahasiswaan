@extends('layouts.admin')

@section('title', 'Edit Aspirasi')

@section('content')
    <div class="container">
        <h1>Edit Aspirasi</h1>

        <form action="{{ route('admin.aspirasi.update', $aspirasi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $aspirasi->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $aspirasi->email }}" required>
            </div>
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan</label>
                <textarea class="form-control" id="pesan" name="pesan" rows="3" required>{{ $aspirasi->pesan }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
