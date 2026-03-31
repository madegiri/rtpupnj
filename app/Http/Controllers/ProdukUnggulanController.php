<?php

namespace App\Http\Controllers;

use App\Models\ProdukUnggulan;
use Illuminate\Http\Request;

class ProdukUnggulanController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->get('search');

        $produkUnggulans = ProdukUnggulan::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(6)
        ->withQueryString();

        return view('pages.produk-unggulan.index', compact('produkUnggulans', 'search'));
    }

    public function show(string $slug)
    {
        $produk = ProdukUnggulan::where('slug', $slug)->firstOrFail();

        $related = ProdukUnggulan::where('id', '!=', $produk->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.produk-unggulan.show', compact('produk', 'related'));
    }
}
