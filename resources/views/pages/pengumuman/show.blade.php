@extends('layouts.app')

@section('title', $pengumuman->judul . ' - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content">
            <div class="col-lg-12">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($pengumuman->judul, 40) }}</li>
                    </ol>
                </nav>

                {{-- Meta --}}
                {{-- <span class="card-chip mb-3">Pengumuman</span> --}}

                <h1 class="article-title">{{ $pengumuman->judul }}</h1>

                <div class="article-meta">
                    <span class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ $pengumuman->created_at->translatedFormat('d F Y') }}
                    </span>
                    <span class="date-sep">·</span>
                    <span class="date-badge">
                        <i class="bi bi-clock"></i>
                        {{ $pengumuman->created_at->format('H:i') }} WIB
                    </span>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        {{-- Thumbnail --}}
                        @if($pengumuman->thumbnail)
                        <div class="article-hero-img">
                            <span class="card-chip">Pengumuman</span>
                            <img src="{{ asset('storage/' . $pengumuman->thumbnail) }}" alt="{{ $pengumuman->judul }}">
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Isi --}}
                <div class="article-body">
                    {!! $pengumuman->isi !!}
                </div>

                {{-- Tombol kembali --}}
                {{-- <div class="mt-5 pt-4" style="border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('pengumuman.index') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Pengumuman
                    </a>
                </div> --}}

            </div>
        </div>

        {{-- ===== PENGUMUMAN TERKAIT ===== --}}
        @if($related->count())
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">Baca Juga</span>
                <h2 class="section-title mt-1">Pengumuman Terkait</h2>
            </div>
            <div class="row g-4">
                @foreach($related as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('pengumuman.show', $item->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">Pengumuman</span>
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi bi-megaphone"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $item->created_at->format('H:i') }} WIB
                            </div>
                            <h6 class="content-card-title">
                                {{ Str::limit($item->judul, 65) }}
                            </h6>
                            <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($item->isi)), 110) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('pengumuman.index') }}" class="btn-lihat-semua">
                    Lihat Semua Pengumuman <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

    </div>
</section>

<style>
/* ─── Breadcrumb ─── */
.breadcrumb-custom {
    background: none;
    padding: 0;
    margin: 0;
    font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a {
    color: #00998a;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.breadcrumb-custom .breadcrumb-item a:hover { color: #006b5e; }
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: #d1d5db;
}

/* ─── Article header ─── */
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

.article-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
    letter-spacing: -0.02em;
    margin: 0.75rem 0 1rem;
}

.article-meta {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    flex-wrap: wrap;
    margin-bottom: 1.75rem;
}

.date-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.78rem;
    font-weight: 500;
    color: #9ca3af;
}

.date-sep { color: #d1d5db; font-size: 0.75rem; }

/* ─── Hero image ─── */
.article-hero-img {
    width: 100%;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 2.25rem;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    position: relative;
}

.article-hero-img img {
    width: 100%;
    max-height: 460px;
    object-fit: cover;
    display: block;
}

/* ─── Article body ─── */
.article-body {
    font-size: 1rem;
    line-height: 1.9;
    color: #374151;
    text-align: justify;
}

.article-body h1,
.article-body h2,
.article-body h3,
.article-body h4 {
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.015em;
    margin-top: 2rem;
    margin-bottom: 0.75rem;
}

.article-body h2 { font-size: 1.4rem; }
.article-body h3 { font-size: 1.2rem; }
.article-body p { margin-bottom: 1.35rem; }

.article-body a {
    color: #00998a;
    text-decoration: underline;
    text-underline-offset: 3px;
    transition: color 0.2s;
}

.article-body a:hover { color: #006b5e; }

.article-body img {
    max-width: 100%;
    border-radius: 10px;
    margin: 1rem 0;
}

.article-body ul,
.article-body ol {
    padding-left: 1.5rem;
    margin-bottom: 1.35rem;
}

.article-body li { margin-bottom: 0.4rem; }

.article-body blockquote {
    border-left: 3px solid #00998a;
    margin: 1.5rem 0;
    padding: 0.75rem 1.25rem;
    background: #f0fdfb;
    border-radius: 0 8px 8px 0;
    color: #4b5563;
    font-style: italic;
}

/* ─── Back button ─── */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
    text-decoration: none;
    transition: color 0.2s;
}

.btn-back:hover { color: #00998a; }

/* ─── Related section ─── */
.related-section {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid #e5e7eb;
}

.related-header { margin-bottom: 1.75rem; }

.section-eyebrow {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #00998a;
    background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18);
    padding: 0.22rem 0.8rem;
    border-radius: 50px;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.02em;
    line-height: 1.25;
    margin: 0;
}

.content-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.content-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.11);
    border-color: transparent;
}
.content-card-thumb {
    width: 100%;
    height: 175px;
    overflow: hidden;
    flex-shrink: 0;
    position: relative;
}
.content-card-thumb img {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
    transition: transform 0.35s ease;
}

.content-card-thumb-placeholder {
    width: 100%; height: 100%;
    background: #f3f4f6;
    display: flex; align-items: center; justify-content: center;
    color: #9ca3af; font-size: 2.25rem;
}
.content-card-body {
    padding: 1.2rem 1.3rem 1.4rem;
    display: flex; flex-direction: column; flex: 1;
}
.content-card-title {
    font-size: 0.9rem; font-weight: 600;
    color: #111827; line-height: 1.45;
    letter-spacing: -0.01em; margin: 0.25rem 0 0;
}
.content-card-title a { color: inherit; text-decoration: none; transition: color 0.2s; }
.content-card-title a:hover { color: #00998a; }
.content-card-excerpt {
    font-size: 0.845rem;
    color: #6b7280;
    line-height: 1.65;
    margin: 0;
    flex: 1;
    text-align: justify;
}

/* ─── Lihat semua ─── */
.btn-lihat-semua {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35);
    background: transparent;
    padding: 0.55rem 1.4rem;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}

.btn-lihat-semua:hover {
    background: #e6f7f5;
    color: #006b5e;
    border-color: #00998a;
}
</style>

@endsection