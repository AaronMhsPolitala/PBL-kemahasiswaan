<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('admin.kelola-anggota-himati.index');
    }

    public function calonAnggota()
    {
        $candidates = Pendaftaran::whereNotIn('status', ['Approved Stage 1', 'Rejected Stage 1'])->get();
        return view('admin.calon-anggota.index', compact('candidates'));
    }

    public function destroy($id)
    {
        $candidate = Pendaftaran::findOrFail($id);
        $candidate->delete();

        return redirect()->route('admin.calon-anggota.index')->with('success', 'Calon anggota berhasil dihapus.');
    }

    public function calonAnggotaTahap1()
    {
        $candidates = Pendaftaran::whereIn('status', ['Approved Stage 1', 'Rejected Stage 1'])->get();
        return view('admin.calon-anggota-tahap-1.index', compact('candidates'));
    }

    public function calonAnggotaTahap2()
    {
        return view('admin.calon-anggota-tahap-2.index');
    }

    public function approveCandidate(Pendaftaran $pendaftaran)
    {
        $pendaftaran->status = 'Approved Stage 1';
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Calon anggota berhasil diterima tahap 1.');
    }

    public function rejectCandidate(Pendaftaran $pendaftaran)
    {
        $pendaftaran->status = 'Rejected Stage 1';
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Calon anggota berhasil ditolak tahap 1.');
    }
}