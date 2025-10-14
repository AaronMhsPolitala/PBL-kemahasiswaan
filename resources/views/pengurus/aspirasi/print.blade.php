<!DOCTYPE html>
<html>
<head>
    <title>Cetak Semua Aspirasi</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h1>Semua Aspirasi</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aspirasis as $aspirasi)
                <tr>
                    <td>{{ $aspirasi->id }}</td>
                    <td>{{ $aspirasi->nama }}</td>
                    <td>{{ $aspirasi->email }}</td>
                    <td>{{ $aspirasi->pesan }}</td>
                    <td>{{ $aspirasi->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
