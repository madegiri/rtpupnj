<?php

namespace App\Http\Controllers;

use App\Models\ProdukUnggulan;
use Illuminate\Http\Request;

class ProdukUnggulanController extends Controller
{
    //
    public function index()
    {
        $produkUnggulans = ProdukUnggulan::latest()->paginate(3);
        return view('pages.produk-unggulan.index', compact('produkUnggulans'));
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
