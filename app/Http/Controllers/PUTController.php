<?php

namespace App\Http\Controllers;

use App\Models\KategoriProdukPUT;
use App\Models\PUTProduk;
use App\Models\UnitPUT;
use Illuminate\Http\Request;

class PUTController extends Controller
{
    //
    // ===================== INDEX - Profil PUT =====================
    public function index(string $unit_slug)
    {
        $unitPut = UnitPUT::where('slug', $unit_slug)->firstOrFail();

        // $profil = PUTProfil::where('unit_put_id', $unitPut->id)->first();

        // Ambil semua kategori milik unit ini
        $kategoris = KategoriProdukPUT::where('unit_put_id', $unitPut->id)
            ->withCount('putProduk')
            ->get();

        // Preview 3 produk terbaru per kategori
        $previewPerKategori = [];
        foreach ($kategoris as $kategori) {
            $previewPerKategori[$kategori->id] = PUTProduk::where('kategori_produk_put_id', $kategori->id)
                ->latest('id')
                ->take(3)
                ->get();
        }

        return view('pages.put.index', compact(
            'unitPut',
            // 'profil',
            'kategoris',
            'previewPerKategori',
        ));
    }

    // ===================== INDEX PER KATEGORI =====================
    public function kategori(string $unit_slug, string $kategori_slug, Request $request)
    {
        $unitPut = UnitPUT::where('slug', $unit_slug)->firstOrFail();

        $kategori = KategoriProdukPUT::where('unit_put_id', $unitPut->id)
            ->where('slug', $kategori_slug)
            ->firstOrFail();

        $search = $request->get('search');

        $produks = PUTProduk::where('kategori_produk_put_id', $kategori->id)
            ->when($search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%");
            })
            ->latest('id')
            ->paginate(9)
            ->withQueryString();

        return view('pages.put.kategori', compact(
            'unitPut',
            'kategori',
            'produks',
            'search',
        ));
    }

    // ===================== SHOW PRODUK =====================
    public function show(string $unit_slug, string $kategori_slug, string $slug)
    {
        $unitPut = UnitPUT::where('slug', $unit_slug)->firstOrFail();

        $kategori = KategoriProdukPUT::where('unit_put_id', $unitPut->id)
            ->where('slug', $kategori_slug)
            ->firstOrFail();

        $produk = PUTProduk::where('kategori_produk_put_id', $kategori->id)
            ->where('slug', $slug)
            ->firstOrFail();

        $related = PUTProduk::where('kategori_produk_put_id', $kategori->id)
            ->where('id', '!=', $produk->id)
            ->latest('id')
            ->take(3)
            ->get();

        return view('pages.put.show', compact(
            'unitPut',
            'kategori',
            'produk',
            'related',
        ));
    }
}
