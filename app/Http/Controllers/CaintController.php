<?php

namespace App\Http\Controllers;

use App\Models\CaintProduk;
use App\Models\CaintProfil;
use Illuminate\Http\Request;

class CaintController extends Controller
{
    //
    // Config kategori dipusatkan di sini
    private function kategoriConfig(): array
    {
        return CaintProduk::KATEGORI_CONFIG;
    }

    // ===================== INDEX CAINT =====================
    public function index()
    {
        $profil = CaintProfil::first();

        // Ambil 3 produk terbaru per kategori untuk preview
        $previewPerKategori = [];
        foreach (array_keys(CaintProduk::KATEGORI_CONFIG) as $kat) {
            $previewPerKategori[$kat] = CaintProduk::where('kategori', $kat)
                ->latest()
                ->take(3)
                ->get();
        }

        // Hitung total per kategori
        $countPerKategori = CaintProduk::selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $config = $this->kategoriConfig();

        return view('pages.caint.index', compact(
            'profil',
            'previewPerKategori',
            'countPerKategori',
            'config'
        ));
    }

    // ===================== INDEX PER KATEGORI =====================
    private function indexKategori(string $kategori, string $view)
    {
        $produks = CaintProduk::where('kategori', $kategori)
            ->latest()
            ->paginate(9);

        $config = $this->kategoriConfig();
        $cfg    = $config[$kategori];

        return view($view, compact('produks', 'config', 'cfg', 'kategori'));
    }

    public function smartCampus()
    {
        return $this->indexKategori('Smart Campus', 'pages.caint.smart-campus.index');
    }

    public function greenEnergy()
    {
        return $this->indexKategori('Green Energy', 'pages.caint.green-energy.index');
    }

    public function industrialAutomation()
    {
        return $this->indexKategori('Industrial Automation', 'pages.caint.industrial-automation.index');
    }

    public function agricultureEnvironment()
    {
        return $this->indexKategori('Agriculture & Environment', 'pages.caint.agriculture-environment.index');
    }

    public function healthcare()
    {
        return $this->indexKategori('Healthcare', 'pages.caint.healthcare.index');
    }

    public function show(string $slug)
    {
        $produk = CaintProduk::where('slug', $slug)->firstOrFail();

        $related = CaintProduk::where('id', '!=', $produk->id)
            ->where('kategori', $produk->kategori)
            ->latest()
            ->take(4)
            ->get();

        // Ambil related dari kategori yang sama saja, tanpa fallback
        $related = CaintProduk::where('id', '!=', $produk->id)
            ->where('kategori', $produk->kategori)
            ->latest()
            ->take(3)
            ->get();

        $config = $this->kategoriConfig();
        $cfg    = $config[$produk->kategori];

        // Map kategori ke nama view folder
        $viewMap = [
            'Smart Campus'            => 'pages.caint.smart-campus.show',
            'Green Energy'            => 'pages.caint.green-energy.show',
            'Industrial Automation'   => 'pages.caint.industrial-automation.show',
            'Agriculture & Environment' => 'pages.caint.agriculture-environment.show',
            'Healthcare'              => 'pages.caint.healthcare.show',
        ];

        $view = $viewMap[$produk->kategori] ?? abort(404);

        return view($view, compact('produk', 'related', 'config', 'cfg'));
    }
}
