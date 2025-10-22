<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prestasi::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('nama_kegiatan', 'like', "%{$search}%");
            });
        }

        // Filter
        if ($request->filled('tingkat_kegiatan')) {
            $query->where('tingkat_kegiatan', $request->tingkat_kegiatan);
        }
        if ($request->filled('keterangan')) {
            $query->where('keterangan', $request->keterangan);
        }

        // Get all matching results
        $allPrestasis = $query->get();

        // Sort by SAW score
        $sortedPrestasis = $allPrestasis->sortByDesc('total_skor');

        // Manual Pagination
        $page = $request->get('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $prestasis = new LengthAwarePaginator(
            $sortedPrestasis->slice($offset, $perPage),
            $sortedPrestasis->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Data for filters
        $tingkat_kegiatans = ['Internal (Kampus)', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
        $keterangans = ['Akademik', 'Non-Akademik'];

        return view('pengurus.prestasi.index', compact('prestasis', 'tingkat_kegiatans', 'keterangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tingkat_kegiatans = ['Internal (Kampus)', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
        $keterangans = ['Akademik', 'Non-Akademik'];
        return view('pengurus.prestasi.create', compact('tingkat_kegiatans', 'keterangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|numeric',
            'nama_mahasiswa' => 'required|string|max:255',
            'ipk' => 'required|numeric|between:0,4.00',
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_penyelenggaraan' => 'required|date',
            'tingkat_kegiatan' => ['required', Rule::in(['Internal (Kampus)', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'])],
            'prestasi_yang_dicapai' => 'required|string|max:255',
            'keterangan' => ['required', Rule::in(['Akademik', 'Non-Akademik'])],
            'bukti_prestasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pembimbing' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('bukti_prestasi')) {
            $path = $request->file('bukti_prestasi')->store('prestasi', 'public');
            $validatedData['bukti_prestasi'] = $path;
        }

        Prestasi::create($validatedData);

        return redirect()->route('pengurus.prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        return view('pengurus.prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        $tingkat_kegiatans = ['Internal (Kampus)', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
        $keterangans = ['Akademik', 'Non-Akademik'];
        return view('pengurus.prestasi.edit', compact('prestasi', 'tingkat_kegiatans', 'keterangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $validatedData = $request->validate([
            'nim' => 'required|numeric',
            'nama_mahasiswa' => 'required|string|max:255',
            'ipk' => 'required|numeric|between:0,4.00',
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_penyelenggaraan' => 'required|date',
            'tingkat_kegiatan' => ['required', Rule::in(['Internal (Kampus)', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'])],
            'prestasi_yang_dicapai' => 'required|string|max:255',
            'keterangan' => ['required', Rule::in(['Akademik', 'Non-Akademik'])],
            'bukti_prestasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pembimbing' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('bukti_prestasi')) {
            // Delete old file
            if ($prestasi->bukti_prestasi) {
                Storage::disk('public')->delete($prestasi->bukti_prestasi);
            }
            // Store new file
            $path = $request->file('bukti_prestasi')->store('prestasi', 'public');
            $validatedData['bukti_prestasi'] = $path;
        }

        $prestasi->update($validatedData);

        return redirect()->route('pengurus.prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        // Delete file
        if ($prestasi->bukti_prestasi) {
            Storage::disk('public')->delete($prestasi->bukti_prestasi);
        }

        $prestasi->delete();
        return redirect()->route('pengurus.prestasi.index')->with('success', 'Data prestasi berhasil dihapus.');
    }

    public function exportCsv(Request $request)
    {
        $query = Prestasi::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('nama_kegiatan', 'like', "%{$search}%");
            });
        }

        // Filter
        if ($request->filled('tingkat_kegiatan')) {
            $query->where('tingkat_kegiatan', $request->tingkat_kegiatan);
        }
        if ($request->filled('keterangan')) {
            $query->where('keterangan', $request->keterangan);
        }

        $prestasis = $query->get();

        $fileName = 'prestasi.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('NIM', 'Nama Mahasiswa', 'IPK', 'Skor', 'Kegiatan', 'Waktu', 'Tingkat', 'Prestasi');

        $callback = function() use($prestasis, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($prestasis as $prestasi) {
                $row['NIM']  = $prestasi->nim;
                $row['Nama Mahasiswa']    = $prestasi->nama_mahasiswa;
                $row['IPK']    = number_format($prestasi->ipk, 2);
                $row['Skor']    = number_format($prestasi->total_skor, 2);
                $row['Kegiatan']  = $prestasi->nama_kegiatan;
                $row['Waktu']  = \Carbon\Carbon::parse($prestasi->waktu_penyelenggaraan)->translatedFormat('d F Y');
                $row['Tingkat']  = $prestasi->tingkat_kegiatan;
                $row['Prestasi']  = $prestasi->prestasi_yang_dicapai;

                fputcsv($file, array($row['NIM'], $row['Nama Mahasiswa'], $row['IPK'], $row['Skor'], $row['Kegiatan'], $row['Waktu'], $row['Tingkat'], $row['Prestasi']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $query = Prestasi::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('nama_kegiatan', 'like', "%{$search}%");
            });
        }

        // Filter
        if ($request->filled('tingkat_kegiatan')) {
            $query->where('tingkat_kegiatan', $request->tingkat_kegiatan);
        }
        if ($request->filled('keterangan')) {
            $query->where('keterangan', $request->keterangan);
        }

        $prestasis = $query->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pengurus.prestasi.prestasi_pdf', compact('prestasis'));
        return $pdf->download('prestasi.pdf');
    }
}
