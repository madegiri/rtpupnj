<?php

namespace App\Http\Controllers;

use App\Models\ArtikelInovasi;
use Illuminate\Http\Request;

class ArtikelInovasiController extends Controller
{
    //

    public function index()
    {
        $artikels = ArtikelInovasi::latest()->paginate(9);

        return view('pages.artikel-inovasi.index', compact('artikels'));
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
