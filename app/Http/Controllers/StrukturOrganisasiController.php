<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    //
    public function index()
    {
        $struktur = StrukturOrganisasi::latest()->first();
        return view('pages.struktur-organisasi.index', compact('struktur'));
    }
}
