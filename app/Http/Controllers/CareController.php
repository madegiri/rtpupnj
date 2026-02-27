<?php

namespace App\Http\Controllers;

use App\Models\CareProfil;
use Illuminate\Http\Request;

class CareController extends Controller
{
    //
    public function index()
    {
        $profil = CareProfil::first();
        
        return view('pages.care.index', compact('profil'));
    }
}
