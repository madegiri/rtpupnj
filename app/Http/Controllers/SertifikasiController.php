<?php

namespace App\Http\Controllers;

use App\Models\Sertifikasi;
use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->get('search');

        $sertifikasis = Sertifikasi::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('penyelenggara', 'like', "%{$search}%");
                });
        })
        ->latest()
        ->paginate(6)
        ->withQueryString();

        return view('pages.sertifikasi.index', compact('sertifikasis', 'search'));
    }

    public function show(string $slug)
    {
        $sertifikasi = Sertifikasi::where('slug', $slug)->firstOrFail();

        $related = Sertifikasi::where('id', '!=', $sertifikasi->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.sertifikasi.show', compact('sertifikasi', 'related'));
    }
}
