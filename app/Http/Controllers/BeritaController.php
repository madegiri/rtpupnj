<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->get('search');

        $beritas = Berita::when($search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(6)
        ->withQueryString();

        return view('pages.berita.index', compact('beritas', 'search'));
    }

    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        $related = Berita::where('id', '!=', $berita->id)
            ->latest()
            ->take(3)->get();

        return view('pages.berita.show', compact('berita', 'related'));
    }
}
