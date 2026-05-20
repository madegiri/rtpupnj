@extends('layouts.app')

@section('title', $produk->judul . ' - ' . $unitPut->nama_singkat_unit_put . ' RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('put.index', $unitPut->slug) }}">
                        {{ $unitPut->nama_singkat_unit_put }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('put.kategori', [$unitPut->slug, $kategori->slug]) }}">
                        {{ $kategori->nama_kategori }}
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ Str::limit($produk->judul, 40) }}</li>
            </ol>
        </nav>

        <div class="row justify-content">
            <div class="col-lg-12">

                <h1 class="article-title">{{ $produk->judul }}</h1>

                <div class="article-meta">
                    @if($produk->user)
                    <span class="date-badge">
                        <i class="bi bi-person"></i>
                        {{ $produk->user->name }}
                    </span>
                    @endif
                    <span class="date-sep">·</span>
                    <span class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ $produk->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                    </span>
                    <span class="date-sep">·</span>
                    <span class="date-badge">
                        <i class="bi bi-clock"></i>
                        {{ $produk->created_at->format('H:i') }} WIB
                    </span>
                </div>

                <div class="row g-4 mb-4">
                    {{-- Poster kiri --}}
                    @if($produk->poster)
                    <div class="col-lg-5">
                        <div class="poster-wrap">
                            <div class="poster-label">
                                <i class="bi bi-file-image"></i> Poster Produk
                            </div>
                            <img src="{{ asset('storage/' . $produk->poster) }}"
                                 alt="Poster {{ $produk->judul }}"
                                 class="poster-img lightbox-trigger"
                                 onclick="openLightbox(this.src)">
                        </div>
                    </div>
                    @endif

                    <div class="col-lg-7">
                        {{-- Thumbnail --}}
                        @if($produk->thumbnail)
                        <div class="article-hero-img mb-3">
                            <span class="card-chip">{{ $kategori->nama_kategori }}</span>
                            <img src="{{ asset('storage/' . $produk->thumbnail) }}"
                                 alt="{{ $produk->judul }}"
                                 class="lightbox-trigger"
                                 onclick="openLightbox(this.src)"
                                 style="width:100%; max-height:340px; object-fit:cover; display:block; cursor:zoom-in;">
                        </div>
                        @endif

                        {{-- Galeri --}}
                        @php
                            $galeri = is_array($produk->galeri)
                                ? $produk->galeri
                                : json_decode($produk->galeri, true);
                        @endphp
                        @if(!empty($galeri) && count($galeri) > 0)
                        <div class="galeri-section mb-0">
                            <h5 class="galeri-title">
                                <i class="bi bi-images"></i> Galeri Produk
                            </h5>
                            <div id="galeriCarousel" class="carousel slide" data-bs-ride="false">
                                <div class="carousel-inner">
                                    @foreach($galeri as $i => $img)
                                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $img) }}"
                                             alt="Galeri {{ $i + 1 }}"
                                             class="galeri-carousel-img lightbox-trigger"
                                             onclick="openLightbox(this.src)">
                                    </div>
                                    @endforeach
                                </div>
                                @if(count($galeri) > 1)
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#galeriCarousel" data-bs-slide="prev">
                                    <span class="galeri-arrow"><i class="bi bi-chevron-left"></i></span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#galeriCarousel" data-bs-slide="next">
                                    <span class="galeri-arrow"><i class="bi bi-chevron-right"></i></span>
                                </button>
                                <div class="galeri-counter">
                                    <span id="galeriCurrent">1</span> / {{ count($galeri) }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-info-circle"></i> Deskripsi Produk
                    </h5>
                    <div class="article-body">
                        {!! $produk->isi !!}
                    </div>
                </div>

            </div>
        </div>

        {{-- Related --}}
        @if($related->count())
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">Lihat Juga</span>
                <h2 class="section-title mt-1">Produk {{ $kategori->nama_kategori }} Lainnya</h2>
            </div>
            <div class="row g-4">
                @foreach($related as $rel)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('put.show', [$unitPut->slug, $kategori->slug, $rel->slug]) }}"
                       class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ $kategori->nama_kategori }}</span>
                            @if($rel->thumbnail)
                                <img src="{{ asset('storage/' . $rel->thumbnail) }}"
                                     alt="{{ $rel->judul }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi bi-box"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $rel->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $rel->created_at->format('H:i') }} WIB
                            </div>
                            <h6 class="content-card-title">
                                {{ Str::limit($rel->judul, 80) }}
                            </h6>
                            <p class="content-card-excerpt">
                                {{ Str::limit(strip_tags($rel->isi), 100) }}
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('put.kategori', [$unitPut->slug, $kategori->slug]) }}"
                   class="btn-lihat-semua">
                    Lihat Semua {{ $kategori->nama_kategori }}
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

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
document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('galeriCarousel');
    if (!carousel) return;
    carousel.addEventListener('slid.bs.carousel', function (e) {
        document.getElementById('galeriCurrent').textContent = e.to + 1;
    });
});

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