<!DOCTYPE html>
<html>
<head>
    <title>Data Prestasi Mahasiswa</title>
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
    <h1>Data Prestasi Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>IPK</th>
                <th>Skor</th>
                <th>Kegiatan</th>
                <th>Waktu</th>
                <th>Tingkat</th>
                <th>Prestasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($prestasis as $prestasi)
                <tr>
                    <td>{{ $prestasi->nim }}</td>
                    <td>{{ $prestasi->nama_mahasiswa }}</td>
                    <td>{{ number_format($prestasi->ipk, 2) }}</td>
                    <td>{{ number_format($prestasi->total_skor, 2) }}</td>
                    <td>{{ $prestasi->nama_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($prestasi->waktu_penyelenggaraan)->translatedFormat('d F Y') }}</td>
                    <td>{{ $prestasi->tingkat_kegiatan }}</td>
                    <td>{{ $prestasi->prestasi_yang_dicapai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data prestasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
