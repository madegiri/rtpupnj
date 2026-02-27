<?php

namespace App\Http\Controllers;

use App\Models\PimpinanRTPU;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    //
    public function index()
    {
        $pimpinans = PimpinanRTPU::all();
        return view('pages.pimpinan.index', compact('pimpinans'));
    }

    public function show(string $slug)
    {
        $pimpinan = PimpinanRtpu::where('slug', $slug)->firstOrFail();

        $related = PimpinanRtpu::where('id', '!=', $pimpinan->id)
            ->take(4)
            ->get();

        return view('pages.pimpinan.show', compact('pimpinan', 'related'));
    }
}
