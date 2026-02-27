<?php

namespace App\Http\Controllers;

use App\Models\TentangRTPU;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    //
    public function index()
    {
        $tentang = TentangRTPU::first();
        return view('pages.tentang.index', compact('tentang'));
    }
}
