@extends('layouts.app')

@section('title', 'PUTOI - Pusat Unggulan Teknologi Otomasi Industri - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Pusat Unggulan Teknologi</li>
                    <li class="breadcrumb-item active">PUTOI</li>
                </ol>
            </nav>
            {{-- <span class="section-eyebrow">Pusat Unggulan Teknologi</span> --}}
            <h1 class="section-title mt-1">
                Pusat Unggulan Teknologi Otomasi Industri
            </h1>
            <p class="section-subtitle">
                <span class="putoi-abbr">(PUTOI)</span>
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                {{-- Thumbnail --}}
                @if($profil && $profil->thumbnail)
                <div class="article-hero-img">
                    <img src="{{ asset('storage/' . $profil->thumbnail) }}" alt="PUTOI">
                </div>
                @endif
            </div>
        </div>

        <div class="row justify-content">
            <div class="col-lg-12">
                {{-- Deskripsi --}}
                @if($profil)
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-building"></i> Tentang PUTOI
                    </h5>
                    <div class="article-body">
                        {!! $profil->deskripsi !!}
                    </div>
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-building"></i>
                    <p>Informasi PUTOI belum tersedia.</p>
                </div>
                @endif

            </div>
        </div>

    </div>
</section>

<style>
/* ─── Breadcrumb ─── */
.breadcrumb-custom {
    background: none; padding: 0; margin-bottom: 1.1rem; font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a {
    color: #00998a; text-decoration: none; font-weight: 500; transition: color 0.2s;
}
.breadcrumb-custom .breadcrumb-item a:hover { color: #006b5e; }
.breadcrumb-custom .breadcrumb-item.active,
.breadcrumb-custom .breadcrumb-item { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

/* ─── Page header ─── */
.section-eyebrow {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem; border-radius: 50px;
}
.section-title {
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.25; margin-bottom: 0.3rem;
}
.section-subtitle { margin: 0; }
.putoi-abbr {
    font-size: 1rem; font-weight: 600; color: #00998a;
}

/* ─── Hero image ─── */
.article-hero-img {
    width: 100%; border-radius: 14px; overflow: hidden;
    margin-bottom: 2rem;
}
.article-hero-img img {
    width: 100%; max-height: 400px; object-fit: contain; display: block;;
}

/* ─── Desc box ─── */
.produk-desc-box {
    background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px; padding: 1.75rem;
}
.produk-desc-title {
    font-size: 1rem; font-weight: 700; color: #111827;
    letter-spacing: -0.01em; margin-bottom: 1rem;
    display: flex; align-items: center; gap: 0.5rem;
}
.produk-desc-title i { color: #00998a; }

/* ─── Article body ─── */
.article-body { font-size: 1rem; line-height: 1.9; color: #374151; }
.article-body p { margin-bottom: 1.25rem; }
.article-body p:last-child { margin-bottom: 0; }
.article-body h2,.article-body h3,.article-body h4 {
    font-weight: 700; color: #111827; letter-spacing: -0.015em;
    margin-top: 1.75rem; margin-bottom: 0.75rem;
}
.article-body a { color: #00998a; text-underline-offset: 3px; }
.article-body a:hover { color: #006b5e; }
.article-body ul, .article-body ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
.article-body li { margin-bottom: 0.4rem; }

/* ─── Empty state ─── */
.empty-state { text-align: center; padding: 4rem 2rem; color: #9ca3af; }
.empty-state i { font-size: 3rem; display: block; margin-bottom: 0.85rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }
</style>

@endsection