<?php

namespace App\Http\Controllers;

use App\Models\KategoriProdukPekanInovasi;
use App\Models\ProdukPekanInovasi;
use App\Models\ProfilPekanInovasi;
use Illuminate\Http\Request;

class PekanInovasiController extends Controller
{
    //
    // GET /pekan-inovasi/{profil_slug}
    // Halaman profil pekan inovasi + preview produk per kategori
    public function index(string $profil_slug)
    {
        $profil = ProfilPekanInovasi::where('slug', $profil_slug)->firstOrFail();

        $kategoris = KategoriProdukPekanInovasi::where('profil_pekan_inovasi_id', $profil->id)
            ->latest()
            ->get();

        // Preview 3 produk terbaru per kategori (tanpa sub kategori)
        $previewPerKategori = [];
        foreach ($kategoris as $kategori) {
            $previewPerKategori[$kategori->id] = ProdukPekanInovasi::where('kategori_produk_pekan_inovasi_id', $kategori->id)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('pages.pekan-inovasi.index', compact('profil', 'kategoris', 'previewPerKategori'));
    }

    // GET /pekan-inovasi/{profil_slug}/{kategori_slug}
    // List produk dalam satu kategori (search + paginate)
    public function kategori(Request $request, string $profil_slug, string $kategori_slug)
    {
        $profil = ProfilPekanInovasi::where('slug', $profil_slug)->firstOrFail();

        $kategori = KategoriProdukPekanInovasi::where('profil_pekan_inovasi_id', $profil->id)
            ->where('slug', $kategori_slug)
            ->firstOrFail();

        $search = $request->get('search');

        $produks = ProdukPekanInovasi::where('kategori_produk_pekan_inovasi_id', $kategori->id)
            ->when($search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('pages.pekan-inovasi.kategori', compact('profil', 'kategori', 'produks', 'search'));
    }

    // GET /pekan-inovasi/{profil_slug}/{kategori_slug}/{slug}
    // Detail produk
    public function show(string $profil_slug, string $kategori_slug, string $slug)
    {
        $profil = ProfilPekanInovasi::where('slug', $profil_slug)->firstOrFail();

        $kategori = KategoriProdukPekanInovasi::where('profil_pekan_inovasi_id', $profil->id)
            ->where('slug', $kategori_slug)
            ->firstOrFail();

        $produk = ProdukPekanInovasi::with('user')
            ->where('kategori_produk_pekan_inovasi_id', $kategori->id)
            ->where('slug', $slug)
            ->firstOrFail();

        $related = ProdukPekanInovasi::where('kategori_produk_pekan_inovasi_id', $kategori->id)
            ->where('id', '!=', $produk->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.pekan-inovasi.show', compact('profil', 'kategori', 'produk', 'related'));
    }
}
