<?php

namespace App\Http\Controllers;

use App\Models\ProdukInovasi;
use Illuminate\Http\Request;

class ProdukInovasiController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->get('search');

        $produkInovasis = ProdukInovasi::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(6)
        ->withQueryString();

        return view('pages.produk-inovasi.index', compact('produkInovasis', 'search'));
    }

    public function show(string $slug)
    {
        $produk = ProdukInovasi::where('slug', $slug)->firstOrFail();

        $related = ProdukInovasi::where('id', '!=', $produk->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.produk-inovasi.show', compact('produk', 'related'));
    }
}
