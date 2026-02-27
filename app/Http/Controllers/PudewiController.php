<?php

namespace App\Http\Controllers;

use App\Models\PudewiProfil;
use Illuminate\Http\Request;

class PudewiController extends Controller
{
    //
    public function index()
    {
        $profil = PudewiProfil::first(); 
        return view('pages.pudewi.index', compact('profil'));
    }
}
