<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Berita;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $beritaCount = Berita::count();
        $aspirasiCount = Aspirasi::count();

        return view('pengurus.index', compact('beritaCount', 'aspirasiCount'));
    }
}
