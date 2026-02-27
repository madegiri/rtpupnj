@extends('layouts.app')

@section('title', $produk->nama . ' - Produk Unggulan RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produk-unggulan.index') }}">Produk Unggulan</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($produk->nama, 40) }}</li>
            </ol>
        </nav>

        <div class="row justify-content">
            <div class="col-lg-12">

                {{-- Meta --}}
                {{-- <span class="card-chip mb-3">Produk Unggulan</span> --}}

                <h1 class="article-title">{{ $produk->nama }}</h1>

                <div class="article-meta">
                    <span class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ $produk->created_at->translatedFormat('d F Y') }}
                    </span>
                    <span class="date-sep">·</span>
                    <span class="date-badge">
                        <i class="bi bi-clock"></i>
                        {{ $produk->created_at->format('H:i') }} WIB
                    </span>
                </div>

                {{-- Layout: Thumbnail+Galeri kiri, Poster kanan --}}
                <div class="row g-4 mb-4">
                    {{-- Poster kanan --}}
                    @if($produk->poster)
                    <div class="col-lg-5">
                        <div class="poster-wrap">
                            <div class="poster-label"><i class="bi bi-file-image"></i>Poster Produk</div>
                            <a href="{{ asset('storage/' . $produk->poster) }}" target="_blank">
                                <img src="{{ asset('storage/' . $produk->poster) }}" alt="Poster {{ $produk->nama }}" class="poster-img">
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="col-lg-7">
                        {{-- Thumbnail --}}
                        @if($produk->gambar)
                        <div class="article-hero-img mb-3">
                            <span class="card-chip">Produk Unggulan</span>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}">
                        </div>
                        @endif

                        {{-- Galeri --}}
                        @php
                            $galeri = isset($produk->galeri)
                                ? (is_string($produk->galeri) ? json_decode($produk->galeri, true) : $produk->galeri)
                                : [];
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
                                        <a href="{{ asset('storage/' . $img) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $img) }}" alt="Galeri {{ $i + 1 }}" class="galeri-carousel-img">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                @if(count($galeri) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#galeriCarousel" data-bs-slide="prev">
                                    <span class="galeri-arrow"><i class="bi bi-chevron-left"></i></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#galeriCarousel" data-bs-slide="next">
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
                        {!! $produk->deskripsi !!}
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== PRODUK LAINNYA ===== --}}
        @if($related->count())
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">Lihat Juga</span>
                <h2 class="section-title mt-1">Produk Unggulan Lainnya</h2>
            </div>
            <div class="row g-4">
                @foreach($related as $item)
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="content-card-thumb">
                            <span class="card-chip">Produk Unggulan</span>
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi bi-star"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            <span class="card-chip">Produk Unggulan</span>
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $item->created_at->format('H:i') }}
                            </div>
                            <h6 class="content-card-title">
                                <a href="{{ route('produk-unggulan.show', $item->slug) }}"
                                   >{{ Str::limit($item->nama, 50) }}</a>
                            </h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('produk-unggulan.index') }}" class="btn-lihat-semua">
                    Lihat Semua Produk Unggulan <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

    </div>
</section>

<style>
/* ─── Breadcrumb ─── */
.breadcrumb-custom {
    background: none; padding: 0; margin: 0; font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a {
    color: #00998a; text-decoration: none; font-weight: 500; transition: color 0.2s;
}
.breadcrumb-custom .breadcrumb-item a:hover { color: #006b5e; }
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

/* ─── Chip ─── */
.card-chip {
    position: absolute;
    top: 0.6rem;
    right: 0.6rem;
    z-index: 1;
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #00998a;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(4px);
    border: 1px solid rgba(0,153,138,0.2);
    padding: 0.16rem 0.6rem;
    border-radius: 50px;
    max-width: calc(100% - 1.2rem);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* ─── Article header ─── */
.article-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700; color: #111827; line-height: 1.4;
    letter-spacing: -0.02em; margin: 0.75rem 0 1rem;
}

.article-meta {
    display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1.75rem;
}

.date-badge {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.78rem; font-weight: 500; color: #9ca3af;
}

.date-sep { color: #d1d5db; font-size: 0.75rem; }

/* ─── Hero image ─── */
.article-hero-img {
    width: 100%; border-radius: 14px; overflow: hidden;
    margin-bottom: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); position: relative;
}
.article-hero-img img {
    width: 100%; max-height: 340px; object-fit: cover; display: block;
}

/* ─── Poster ─── */
.poster-wrap {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 1.25rem;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.poster-label {
    font-size: 0.95rem; font-weight: 700; color: #111827;
    display: flex; align-items: center; gap: 0.5rem;
    margin-bottom: 1rem;
}
.poster-label i { color: #00998a; }
.poster-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 8px;
    flex: 1;
    min-height: 0;
    cursor: zoom-in;
    transition: opacity 0.2s;
}
.poster-img:hover { opacity: 0.9; }

/* ─── Galeri Carousel ─── */
.galeri-section {
    background: #f9fafb; border: 1px solid #e5e7eb;
    border-radius: 14px; padding: 1.5rem; margin-bottom: 2rem;
}
.galeri-title {
    font-size: 0.95rem; font-weight: 700; color: #111827;
    display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;
}
.galeri-title i { color: #00998a; }

.carousel { position: relative; border-radius: 10px; overflow: hidden; }

.galeri-carousel-img {
    width: 100%; height: 340px;
    object-fit: cover; display: block; border-radius: 10px;
}

.galeri-arrow {
    width: 38px; height: 38px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(4px);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #111827; font-size: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: background 0.2s;
}
.galeri-arrow:hover { background: #ffffff; }

.carousel-control-prev { left: 0.75rem; width: auto; }
.carousel-control-next { right: 0.75rem; width: auto; }
.carousel-control-prev-icon,
.carousel-control-next-icon { display: none; }

.galeri-counter {
    position: absolute; bottom: 0.75rem; right: 0.85rem;
    background: rgba(0,0,0,0.45); color: #fff;
    font-size: 0.75rem; font-weight: 600;
    padding: 0.2rem 0.65rem; border-radius: 50px;
    backdrop-filter: blur(4px);
}

@media (max-width: 575.98px) {
    .galeri-carousel-img { height: 220px; }
}

/* ─── Deskripsi box ─── */
.produk-desc-box {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 1.75rem;
}

.produk-desc-title {
    font-size: 1rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.01em;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.produk-desc-title i { color: #00998a; }

/* ─── Article body ─── */
.article-body { font-size: 1rem; line-height: 1.9; color: #374151; }
.article-body p { margin-bottom: 1.25rem; }
.article-body p:last-child { margin-bottom: 0; }

/* ─── Action buttons ─── */
.btn-back {
    display: inline-flex; align-items: center; gap: 0.45rem;
    font-size: 0.875rem; font-weight: 500; color: #6b7280;
    text-decoration: none; transition: color 0.2s;
}
.btn-back:hover { color: #00998a; }

.btn-contact {
    display: inline-flex; align-items: center; gap: 0.45rem;
    font-size: 0.875rem; font-weight: 600; color: #ffffff;
    background: #00998a; border: none; padding: 0.55rem 1.4rem;
    border-radius: 50px; text-decoration: none;
    transition: background 0.22s ease, transform 0.22s ease;
}
.btn-contact:hover { background: #006b5e; color: #ffffff; transform: translateY(-1px); }

/* ─── Related section ─── */
.related-section {
    margin-top: 4rem; padding-top: 3rem; border-top: 1px solid #e5e7eb;
}
.related-header { margin-bottom: 1.75rem; }

.section-eyebrow {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem; border-radius: 50px;
}
.section-title {
    font-size: 1.5rem; font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.25; margin: 0;
}

/* ─── Content Card ─── */
.content-card {
    background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px;
    overflow: hidden; display: flex; flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.content-card:hover {
    transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,0.11); border-color: transparent;
}
.content-card-thumb { width: 100%; height: 175px; overflow: hidden; flex-shrink: 0; position: relative;}
.content-card-thumb img {
    width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.35s ease;
}
.content-card:hover .content-card-thumb img { transform: scale(1.04); }
.content-card-thumb-placeholder {
    width: 100%; height: 100%; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2.25rem;
}
.content-card-body {
    padding: 1.2rem 1.3rem 1.4rem; display: flex; flex-direction: column; flex: 1;
}
.content-card-title {
    font-size: 0.9rem; font-weight: 600; color: #111827;
    line-height: 1.45; letter-spacing: -0.01em; margin: 0.25rem 0 0;
}
.content-card-title a { color: inherit; text-decoration: none; transition: color 0.2s; }
.content-card-title a:hover { color: #00998a; }

/* ─── Lihat semua ─── */
.btn-lihat-semua {
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-size: 0.85rem; font-weight: 600; color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35); background: transparent;
    padding: 0.55rem 1.4rem; border-radius: 50px; text-decoration: none;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.btn-lihat-semua:hover { background: #e6f7f5; color: #006b5e; border-color: #00998a; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('galeriCarousel');
    if (!carousel) return;
    carousel.addEventListener('slid.bs.carousel', function (e) {
        document.getElementById('galeriCurrent').textContent = e.to + 1;
    });
});
</script>

@endsection