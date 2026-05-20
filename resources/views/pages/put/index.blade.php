@extends('layouts.app')

@section('title', $unitPut->nama_lengkap_unit_put . ' - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Pusat Unggulan</li>
                    <li class="breadcrumb-item active">{{ $unitPut->nama_singkat_unit_put }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ $unitPut->nama_lengkap_unit_put }}</h1>
            <p class="section-subtitle">
                <span class="put-abbr">({{ $unitPut->nama_singkat_unit_put }})</span>
            </p>
        </div>

        {{-- Thumbnail Profil --}}
        @if($unitPut->thumbnail)
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="article-hero-img">
                    <img src="{{ asset('storage/' . $unitPut->thumbnail) }}"
                         alt="{{ $unitPut->nama_singkat_unit_put }}">
                </div>
            </div>
        </div>
        @endif

        {{-- Deskripsi Profil --}}
        @if($unitPut->deskripsi)
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-building"></i>
                        Tentang {{ $unitPut->nama_singkat_unit_put }}
                    </h5>
                    <div class="article-body">
                        {!! $unitPut->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Galeri Poster --}}
        @if(!empty($unitPut->poster))
        @php
            $posters = is_array($unitPut->poster) ? $unitPut->poster : json_decode($unitPut->poster, true);
        @endphp
        @if(!empty($posters))
        <div class="poster-section mb-5">
            <h5 class="produk-desc-title mb-4">
                <i class="bi bi-images"></i> Poster {{ $unitPut->nama_singkat_unit_put }}
            </h5>
            <div class="row g-3">
                @foreach($posters as $i => $poster)
                <div class="col-6 col-sm-4 col-lg-3">
                    <div class="poster-card"
                         onclick="openLightbox('{{ asset('storage/' . $poster) }}')">
                        <img src="{{ asset('storage/' . $poster) }}"
                             alt="Poster {{ $unitPut->nama_singkat_unit_put }} {{ $i + 1 }}">
                        <div class="poster-overlay">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endif

        {{-- Preview Per Kategori --}}
        @foreach($kategoris as $kategori)
        @php $produks = $previewPerKategori[$kategori->id] ?? collect(); @endphp

        <div class="kategori-section">
            <div class="kategori-header">
                <div class="kategori-header-left">
                    <span class="section-eyebrow">Kategori</span>
                    <h2 class="section-title mt-1">{{ $kategori->nama_kategori }}</h2>
                    {{-- <p class="kategori-count">
                        <i class="bi bi-grid-3x3-gap"></i>
                        {{ $kategori->put_produk_count }} produk tersedia
                    </p> --}}
                </div>
                <a href="{{ route('put.kategori', [$unitPut->slug, $kategori->slug]) }}"
                   class="btn-lihat-semua">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('put.show', [$unitPut->slug, $kategori->slug, $produk->slug]) }}"
                       class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ $kategori->nama_kategori }}</span>
                            @if($produk->thumbnail)
                                <img src="{{ asset('storage/' . $produk->thumbnail) }}"
                                     alt="{{ $produk->judul }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi bi-box"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $produk->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $produk->created_at->format('H:i') }} WIB
                            </div>
                            <h6 class="content-card-title">
                                {{ Str::limit($produk->judul, 80) }}
                            </h6>
                            <p class="content-card-excerpt">
                                {{ Str::limit(strip_tags($produk->isi), 100) }}
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="bi bi-box"></i>
                <p>Belum ada produk untuk kategori ini.</p>
            </div>
            @endif
        </div>

        @if(!$loop->last)
        <div class="kategori-divider"></div>
        @endif

        @endforeach

    </div>
</section>

{{-- Lightbox --}}
<div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">
        <i class="bi bi-x-lg"></i>
    </button>
    <img src="" alt="" class="lightbox-img" id="lightboxImg"
         onclick="event.stopPropagation()">
</div>

@include('pages.put._styles')

<script>
function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightboxOverlay').classList.remove('active');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLightbox();
});
</script>
@endsection