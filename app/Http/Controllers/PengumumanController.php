<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    //
    public function index()
{
    $pengumumans = Pengumuman::latest()->paginate(6);
    return view('pages.pengumuman.index', compact('pengumumans'));
}

public function show(string $slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();
        $related = Pengumuman::where('id', '!=', $pengumuman->id)->latest()->take(3)->get();
        return view('pages.pengumuman.show', compact('pengumuman', 'related'));
    }
}
