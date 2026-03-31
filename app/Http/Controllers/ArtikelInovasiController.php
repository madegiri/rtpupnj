<?php

namespace App\Http\Controllers;

use App\Models\ArtikelInovasi;
use Illuminate\Http\Request;

class ArtikelInovasiController extends Controller
{
    //

    public function index(Request $request)
    {
        $search = $request->get('search');

        $artikels = ArtikelInovasi::when($search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString(); 

        return view('pages.artikel-inovasi.index', compact('artikels', 'search'));
    }

    public function show(string $slug)
    {
        $artikel = ArtikelInovasi::where('slug', $slug)->firstOrFail();

        $related = ArtikelInovasi::where('id', '!=', $artikel->id)
            ->latest()
            ->take(3)->get();

        return view('pages.artikel-inovasi.show', compact('artikel', 'related'));
    }
}
