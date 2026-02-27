<?php

namespace App\Http\Controllers;

use App\Models\ProdukInovasi;
use Illuminate\Http\Request;

class ProdukInovasiController extends Controller
{
    //
    public function index()
    {
        $produkInovasis = ProdukInovasi::latest()->paginate(12);
        return view('pages.produk-inovasi.index', compact('produkInovasis'));
    }

    public function show(string $slug)
    {
        $produk = ProdukInovasi::where('slug', $slug)->firstOrFail();

        $related = ProdukInovasi::where('id', '!=', $produk->id)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.produk-inovasi.show', compact('produk', 'related'));
    }
}
