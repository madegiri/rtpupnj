<?php

namespace App\Http\Controllers;

use App\Models\ArtikelInovasi;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\ProdukInovasi;
use App\Models\ProdukUnggulan;
use App\Models\Sertifikasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
{
    $artikelInovasi = ArtikelInovasi::latest()->take(3)->get();
    $beritartpu = Berita::latest()->take(3)->get();
    $pengumumanrtpu = Pengumuman::latest()->take(3)->get();
    $produkUnggulan = ProdukUnggulan::latest()->take(4)->get();
    $produkInovasi = ProdukInovasi::latest()->take(4)->get();
    $sertifikasirtpu = Sertifikasi::latest()->take(4)->get();

    $stats = [
        'artikel_inovasi' => ArtikelInovasi::count(),
        'produk_unggulan' => ProdukUnggulan::count(),
        'produk_inovasi' => ProdukInovasi::count(),
        'sertifikasi'    => Sertifikasi::count(),
    ];

    return view('home', compact(
        'artikelInovasi',
        'beritartpu',
        'pengumumanrtpu',
        'produkUnggulan',
        'produkInovasi',
        'sertifikasirtpu',
        'stats'
    ));
}
}
