@extends('layouts.app')

@section('title', $sertifikasi->nama . ' - Sertifikasi RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sertifikasi.index') }}">Sertifikasi</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($sertifikasi->nama, 40) }}</li>
            </ol>
        </nav>

        <div class="row justify-content">
            <div class="col-lg-12">

                {{-- Meta --}}
                {{-- <span class="card-chip mb-3">{{ Str::limit($sertifikasi->penyelenggara, 40) }}</span> --}}

                <h1 class="article-title">{{ $sertifikasi->nama }}</h1>

                <div class="article-meta">
                    <span class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ $sertifikasi->created_at->translatedFormat('d F Y') }}
                    </span>
                    <span class="date-sep">·</span>
                    <span class="date-badge">
                        <i class="bi bi-clock"></i>
                        {{ $sertifikasi->created_at->format('H:i') }} WIB
                    </span>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        {{-- Gambar --}}
                        @if($sertifikasi->gambar)
                        <div class="article-hero-img">
                            <span class="card-chip">{{ Str::limit($sertifikasi->penyelenggara, 40) }}</span>
                            <img src="{{ asset('storage/' . $sertifikasi->gambar) }}" alt="{{ $sertifikasi->nama }}">
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Info Penyelenggara --}}
                <div class="info-penyelenggara">
                    <div class="penyelenggara-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div>
                        <div class="penyelenggara-label">Penyelenggara</div>
                        <div class="penyelenggara-name">{{ $sertifikasi->penyelenggara }}</div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-award"></i> Deskripsi
                    </h5>
                    <div class="article-body">
                        {!! $sertifikasi->deskripsi !!}
                    </div>
                </div>

                {{-- Tombol aksi --}}
                {{-- <div class="d-flex gap-3 flex-wrap mt-5 pt-4" style="border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('sertifikasi.index') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('hubungi-kami') }}" class="btn-contact">
                        <i class="bi bi-envelope"></i> Hubungi Kami
                    </a>
                </div> --}}

            </div>
        </div>

        {{-- ===== SERTIFIKASI LAINNYA ===== --}}
        @if($related->count())
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">Lihat Juga</span>
                <h2 class="section-title mt-1">Sertifikasi Lainnya</h2>
            </div>
            <div class="row g-4">
                @foreach($related as $item)
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ Str::limit($item->penyelenggara, 30) }}</span>
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi bi-award"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $item->created_at->format('H:i') }}
                            </div>
                            <h6 class="content-card-title">
                                <a href="{{ route('sertifikasi.show', $item->slug) }}"
                                   >{{ Str::limit($item->nama, 55) }}</a>
                            </h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('sertifikasi.index') }}" class="btn-lihat-semua">
                    Lihat Semua Sertifikasi <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

    </div>
</section>

<style>
.breadcrumb-custom {
    background: none; padding: 0; margin: 0; font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a {
    color: #00998a; text-decoration: none; font-weight: 500; transition: color 0.2s;
}
.breadcrumb-custom .breadcrumb-item a:hover { color: #006b5e; }
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

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
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 700; color: #111827;
    line-height: 1.4; letter-spacing: -0.02em; margin: 0.75rem 0 1rem;
}

.article-meta {
    display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1.75rem;
}

.date-badge {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.78rem; font-weight: 500; color: #9ca3af;
}
.date-sep { color: #d1d5db; font-size: 0.75rem; }

.article-hero-img {
    width: 100%; border-radius: 14px; overflow: hidden;
    margin-bottom: 1.75rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); position: relative;
}
.article-hero-img img {
    width: 100%; max-height: 460px; object-fit: cover; display: block;
}

/* ─── Info penyelenggara ─── */
.info-penyelenggara {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.25rem;
}

.penyelenggara-icon {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    background: #e6f7f5;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #00998a;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.penyelenggara-label {
    font-size: 0.72rem;
    font-weight: 500;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 0.15rem;
}

.penyelenggara-name {
    font-size: 0.95rem;
    font-weight: 600;
    color: #111827;
}

/* ─── Deskripsi box ─── */
.produk-desc-box {
    background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px; padding: 1.75rem;
}
.produk-desc-title {
    font-size: 1rem; font-weight: 700; color: #111827;
    letter-spacing: -0.01em; margin-bottom: 1rem;
    display: flex; align-items: center; gap: 0.5rem;
}
.produk-desc-title i { color: #00998a; }

.article-body { font-size: 1rem; line-height: 1.9; color: #374151; }
.article-body p { margin-bottom: 1.25rem; }
.article-body p:last-child { margin-bottom: 0; }

/* ─── Buttons ─── */
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
.related-section { margin-top: 4rem; padding-top: 3rem; border-top: 1px solid #e5e7eb; }
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
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease; position: relative;
}
.content-card:hover {
    transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,0.11); border-color: transparent;
}
.content-card-thumb { width: 100%; height: 175px; overflow: hidden; flex-shrink: 0; }
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

.btn-lihat-semua {
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-size: 0.85rem; font-weight: 600; color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35); background: transparent;
    padding: 0.55rem 1.4rem; border-radius: 50px; text-decoration: none;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.btn-lihat-semua:hover { background: #e6f7f5; color: #006b5e; border-color: #00998a; }
</style>

@endsection