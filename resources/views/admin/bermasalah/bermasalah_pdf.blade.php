<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa Bermasalah</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Mahasiswa Bermasalah</h1>
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jenis Masalah</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduans as $pengaduan)
                <tr>
                    <td>{{ $pengaduan->nim ?? 'Anonim' }}</td>
                    <td>{{ $pengaduan->nama ?? 'Anonim' }}</td>
                    <td>{{ $pengaduan->jenis_masalah }}</td>
                    <td>{{ $pengaduan->keterangan }}</td>
                    <td>{{ $pengaduan->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data pengaduan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
