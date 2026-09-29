<?php

namespace App\Http\Controllers;

use App\Models\KategoriKonten;
use App\Models\Konten;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    //
    public function index(Request $request, string $kategoriSlug)
    {
        $kategori = KategoriKonten::where('slug', $kategoriSlug)->firstOrFail();
 
        $search = $request->get('search');
 
        $kontens = Konten::where('kategori_konten_id', $kategori->id)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");

                    if (app()->getLocale() !== 'id') {
                        $translated = TranslateService::toIndonesian($search, app()->getLocale());
                        if ($translated && $translated !== $search) {
                            $q->orWhere('judul', 'like', "%{$translated}%");
                        }
                    }
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();
 
        return view('pages.konten.index', compact('kategori', 'kontens', 'search'));
    }
 
    public function show(string $kategoriSlug, string $slug)
    {
        $kategori = KategoriKonten::where('slug', $kategoriSlug)->firstOrFail();
 
        $konten = Konten::where('kategori_konten_id', $kategori->id)
            ->where('slug', $slug)
            ->firstOrFail();
 
        $related = Konten::where('kategori_konten_id', $kategori->id)
            ->where('id', '!=', $konten->id)
            ->latest()
            ->take(3)
            ->get();
 
        return view('pages.konten.show', compact('kategori', 'konten', 'related'));
    }
}
