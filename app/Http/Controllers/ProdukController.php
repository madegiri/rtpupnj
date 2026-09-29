<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //
    public function index(Request $request, string $kategoriSlug)
    {
        $kategori = KategoriProduk::where('slug', $kategoriSlug)->firstOrFail();
 
        $search = $request->get('search');
 
        $produks = Produk::where('kategori_produk_id', $kategori->id)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");

                    if (app()->getLocale() !== 'id') {
                        $translated = \App\Services\TranslateService::toIndonesian($search, app()->getLocale());
                        if ($translated && $translated !== $search) {
                            $q->orWhere('nama', 'like', "%{$translated}%");
                        }
                    }
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();
 
        return view('pages.produk.index', compact('kategori', 'produks', 'search'));
    }
 
    public function show(string $kategoriSlug, string $slug)
    {
        $kategori = KategoriProduk::where('slug', $kategoriSlug)->firstOrFail();
 
        $produk = Produk::where('kategori_produk_id', $kategori->id)
            ->where('slug', $slug)
            ->firstOrFail();
 
        $related = Produk::where('kategori_produk_id', $kategori->id)
            ->where('id', '!=', $produk->id)
            ->latest()
            ->take(3)
            ->get();
 
        return view('pages.produk.show', compact('kategori', 'produk', 'related'));
    }
}
