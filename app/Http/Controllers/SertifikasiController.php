<?php

namespace App\Http\Controllers;

use App\Models\Sertifikasi;
use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    //
    public function index()
    {
        $sertifikasis = Sertifikasi::latest()->paginate(12);
        return view('pages.sertifikasi.index', compact('sertifikasis'));
    }

    public function show(string $slug)
    {
        $sertifikasi = Sertifikasi::where('slug', $slug)->firstOrFail();

        $related = Sertifikasi::where('id', '!=', $sertifikasi->id)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.sertifikasi.show', compact('sertifikasi', 'related'));
    }
}
