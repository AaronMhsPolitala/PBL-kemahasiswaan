<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class UserPrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::query();

        // Filtering
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }
        if ($request->filled('sistem_kuliah')) {
            $query->where('sistem_kuliah', $request->sistem_kuliah);
        }

        // Searching
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $prestasis = $query->latest()->paginate(10)->withQueryString();

        // For filter dropdowns
        $periodes = Prestasi::select('periode')->distinct()->orderBy('periode', 'desc')->get();
        $sistemKuliahs = Prestasi::select('sistem_kuliah')->distinct()->get();

        return view('user.prestasi', [
            'prestasis' => $prestasis,
            'periodes' => $periodes,
            'sistemKuliahs' => $sistemKuliahs,
        ]);
    }
}
