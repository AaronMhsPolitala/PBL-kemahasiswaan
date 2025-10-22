<!DOCTYPE html>
<html>
<head>
    <title>Data Calon Anggota Tahap 1</title>
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
    <h1>Data Calon Anggota Tahap 1</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>NIM</th>
                <th>Nomor HP</th>
                <th>Divisi Tujuan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->nim ?? 'N/A' }}</td>
                    <td>{{ $candidate->hp ?? 'N/A' }}</td>
                    <td>{{ $candidate->divisi->nama_divisi ?? 'N/A' }}</td>
                    <td>{{ $statuses[$candidate->status] ?? $candidate->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data calon anggota tahap 1.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
