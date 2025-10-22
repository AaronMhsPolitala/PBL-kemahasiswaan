<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class UserPendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'hp' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'alasan' => 'required|string',
        ]);

        Pendaftaran::create([
            'name' => $request->nama,
            'nim' => $request->nim,
            'hp' => $request->hp,
            'divisi' => $request->divisi,
            'alasan_bergabung' => $request->alasan,
        ]);

        return redirect()->route('user.pendaftaran')->with('success', 'Pendaftaran berhasil! Terima kasih telah mendaftar.');
    }
}