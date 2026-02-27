<?php

namespace App\Http\Controllers;

use App\Models\AkSENProfil;
use Illuminate\Http\Request;

class AkSENController extends Controller
{
    //
    public function index()
    {
        $profil = AkSENProfil::first();
        return view('pages.aksen.index', compact('profil'));
    }
}
