<?php

namespace App\Http\Controllers;

use App\Models\KategoriProdukPUT;
use App\Models\SubKategoriProdukPUT;
use App\Models\PUTProduk;
use App\Models\UnitPUT;
use Illuminate\Http\Request;

class PUTController extends Controller
{
    // ===================== INDEX - Profil PUT (list kategori) =====================
    public function index(string $unit_slug)
    {
        $unitPut = UnitPUT::where('slug', $unit_slug)->firstOrFail();

        $kategoris = KategoriProdukPUT::where('unit_put_id', $unitPut->id)->get();

        // Preview 3 produk terbaru per kategori (lintas semua sub kategori di dalamnya)
        $previewPerKategori = [];
        foreach ($kategoris as $kategori) {
            $subKategoriIds = SubKategoriProdukPUT::where('kategori_produk_put_id', $kategori->id)
                ->pluck('id');

            $previewPerKategori[$kategori->id] = PUTProduk::whereIn('sub_kategori_produk_put_id', $subKategoriIds)
                ->latest('id')
                ->take(3)
                ->get();
        }

        return view('pages.put.index', compact('unitPut', 'kategoris', 'previewPerKategori'));
    }

    // ===================== KATEGORI - breakdown sub kategori =====================
    public function kategori(string $unit_slug, string $kategori_slug)
    {
        $unitPut = UnitPUT::where('slug', $unit_slug)->firstOrFail();

        $kategori = KategoriProdukPUT::where('unit_put_id', $unitPut->id)
            ->where('slug', $kategori_slug)
            ->firstOrFail();

        $subKategoris = SubKategoriProdukPUT::where('kategori_produk_put_id', $kategori->id)->get();

        // Preview 3 produk terbaru per sub kategori
        $previewPerSubKategori = [];
        foreach ($subKategoris as $sub) {
            $previewPerSubKategori[$sub->id] = PUTProduk::where('sub_kategori_produk_put_id', $sub->id)
                ->latest('id')
                ->take(3)
                ->get();
        }

        return view('pages.put.kategori', compact('unitPut', 'kategori', 'subKategoris', 'previewPerSubKategori'));
    }

    // ===================== SUB KATEGORI - list produk (dulu ini "kategori()") =====================
    public function subKategori(string $unit_slug, string $kategori_slug, string $sub_kategori_slug, Request $request)
    {
        $unitPut = UnitPUT::where('slug', $unit_slug)->firstOrFail();

        $kategori = KategoriProdukPUT::where('unit_put_id', $unitPut->id)
            ->where('slug', $kategori_slug)
            ->firstOrFail();

        $subKategori = SubKategoriProdukPUT::where('kategori_produk_put_id', $kategori->id)
            ->where('slug', $sub_kategori_slug)
            ->firstOrFail();

        $search = $request->get('search');

        $produks = PUTProduk::where('sub_kategori_produk_put_id', $subKategori->id)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");

                    if (app()->getLocale() !== 'id') {
                        $translated = \App\Services\TranslateService::toIndonesian($search, app()->getLocale());
                        if ($translated && $translated !== $search) {
                            $q->orWhere('judul', 'like', "%{$translated}%");
                        }
                    }
                });
            })
            ->latest('id')
            ->paginate(6)
            ->withQueryString();

        return view('pages.put.sub_kategori', compact('unitPut', 'kategori', 'subKategori', 'produks', 'search'));
    }

    // ===================== SHOW PRODUK =====================
    public function show(string $unit_slug, string $kategori_slug, string $sub_kategori_slug, string $slug)
    {
        $unitPut = UnitPUT::where('slug', $unit_slug)->firstOrFail();

        $kategori = KategoriProdukPUT::where('unit_put_id', $unitPut->id)
            ->where('slug', $kategori_slug)
            ->firstOrFail();

        $subKategori = SubKategoriProdukPUT::where('kategori_produk_put_id', $kategori->id)
            ->where('slug', $sub_kategori_slug)
            ->firstOrFail();

        $produk = PUTProduk::where('sub_kategori_produk_put_id', $subKategori->id)
            ->where('slug', $slug)
            ->firstOrFail();

        $related = PUTProduk::where('sub_kategori_produk_put_id', $subKategori->id)
            ->where('id', '!=', $produk->id)
            ->latest('id')
            ->take(3)
            ->get();

        return view('pages.put.show', compact('unitPut', 'kategori', 'subKategori', 'produk', 'related'));
    }
}