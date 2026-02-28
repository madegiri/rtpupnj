<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    //
    public function index()
    {
        $strukturs = StrukturOrganisasi::all();
        return view('pages.struktur-organisasi.index', compact('strukturs'));
    }

    public function show(string $slug)
    {
        $strukturorgs = StrukturOrganisasi::where('slug', $slug)->firstOrFail();

        $related = StrukturOrganisasi::where('id', '!=', $strukturorgs->id)
            ->take(4)
            ->get();

        return view('pages.struktur-organisasi.show', compact('strukturorgs', 'related'));
    }
}
