<?php

namespace App\Http\Controllers;

use App\Models\PutoiProfil;
use Illuminate\Http\Request;

class PutoiController extends Controller
{
    //
    public function index()
    {

        $profil = PutoiProfil::first();

        return view('pages.putoi.index', compact('profil'));
    }
}
