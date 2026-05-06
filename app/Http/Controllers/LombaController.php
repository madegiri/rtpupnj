<?php

namespace App\Http\Controllers;

use App\Models\KategoriLomba;
use App\Models\Lomba;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    //
    public function index(Request $request)
    {
        $search           = $request->get('search');
        $kategori         = $request->get('kategori');
        $peserta          = $request->get('peserta');
        $jenis            = $request->get('jenis');

        $lombas = Lomba::with('kategoriLomba')
            ->when($search, fn($q) => $q->where('nama_lomba', 'like', "%{$search}%"))
            ->when($kategori, fn($q) => $q->where('kategori_lomba_id', $kategori))
            ->when($peserta, fn($q) => $q->whereJsonContains('kategori_peserta', $peserta))
            ->when($jenis, fn($q) => $q->where('jenis_pelaksanaan', $jenis))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $kategoriList = KategoriLomba::orderBy('nama_kategori')->get();

        return view('pages.lomba.index', compact('lombas', 'search', 'kategori', 'peserta', 'jenis', 'kategoriList'));
    }

    public function show(string $slug)
    {
        $lomba = Lomba::with('kategoriLomba')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Lomba::where('id', '!=', $lomba->id)
            ->where('kategori_lomba_id', $lomba->kategori_lomba_id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.lomba.show', compact('lomba', 'related'));
    }
}
