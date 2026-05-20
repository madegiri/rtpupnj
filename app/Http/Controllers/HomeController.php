<?php

namespace App\Http\Controllers;

use App\Models\ArtikelInovasi;
use App\Models\Berita;
use App\Models\KategoriKonten;
use App\Models\KategoriProduk;
use App\Models\Pengumuman;
use App\Models\ProdukInovasi;
use App\Models\ProdukUnggulan;
use App\Models\Sertifikasi;
use App\Models\UnitPUT;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    const BERANDA_SLUGS = ['artikel-inovasi', 'berita', 'pengumuman'];

    const PRODUK_SLUGS = ['produk-unggulan', 'produk-inovasi'];

    public function index()
    {
        // $artikelInovasi = ArtikelInovasi::latest()->take(3)->get();
        // $beritartpu = Berita::latest()->take(3)->get();
        // $pengumumanrtpu = Pengumuman::latest()->take(3)->get();

        $berandaKonten = KategoriKonten::whereIn('slug', self::BERANDA_SLUGS)
                ->get()
                ->keyBy('slug')
                ->each(function ($kategori) {
                    $kategori->setRelation(
                        'konten',
                        $kategori->konten()->latest()->take(3)->get()
                    );
                });
        
        // $produkUnggulan = ProdukUnggulan::latest()->take(3)->get();
        // $produkInovasi = ProdukInovasi::latest()->take(3)->get();

        $produkKategori = KategoriProduk::whereIn('slug', self::PRODUK_SLUGS)
                ->get()
                ->keyBy('slug')
                ->each(function ($kategori) {
                    $kategori->setRelation(
                        'produk',
                        $kategori->produk()->latest()->take(3)->get()
                    );
                });

        $unitPutsHome = UnitPUT::latest()->take(3)->get();

        $sertifikasirtpu = Sertifikasi::latest()->take(3)->get();

        // $stats = [
        //     'artikel_inovasi' => ArtikelInovasi::count(),
        //     'produk_unggulan' => ProdukUnggulan::count(),
        //     'produk_inovasi' => ProdukInovasi::count(),
        //     'sertifikasi'    => Sertifikasi::count(),
        // ];

        $stats = [
            'unit_put'        => UnitPUT::count(),
            'kategori_produk' => KategoriProduk::count(),
            'produk'          => \App\Models\Produk::count(), // sesuaikan model name-nya
            'sertifikasi'     => Sertifikasi::count(),
        ];

        return view('home', compact(
            // 'artikelInovasi',
            // 'beritartpu',
            // 'pengumumanrtpu',
            'berandaKonten',
            'produkKategori',
            // 'produkUnggulan',
            // 'produkInovasi',
            'sertifikasirtpu',
            'unitPutsHome',
            'stats'
        ));
    }
}
