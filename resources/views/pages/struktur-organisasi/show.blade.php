@extends('layouts.app')

@section('title', $strukturorgs->nama . ' - Pimpinan RTPU PNJ')

@section('content')
<section class="so-page">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="so-breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tentang.index') }}">Tentang</a></li>
                <li class="breadcrumb-item"><a href="{{ route('struktur-organisasi.index') }}">Struktur Organisasi</a></li>
                <li class="breadcrumb-item active">{{ $strukturorgs->nama }}</li>
            </ol>
        </nav>

        {{-- Hero --}}
        <div class="so-hero">
            <div class="so-hero-photo">
                @if($strukturorgs->gambar)
                    <img src="{{ asset('storage/' . $strukturorgs->gambar) }}" alt="{{ $strukturorgs->nama }}">
                @else
                    <div class="so-photo-placeholder">
                        <i class="bi bi-person"></i>
                    </div>
                @endif
            </div>

            <div class="so-hero-body">
                <span class="so-jabatan-chip">{{ $strukturorgs->jabatan }}</span>
                <h1 class="so-name">{{ $strukturorgs->nama }}</h1>
                <p class="so-institusi">
                    <i class="bi bi-building"></i>
                    Politeknik Negeri Jakarta
                </p>

                <div class="so-divider"></div>

                {{-- Author meta --}}
                @if($strukturorgs->user)
                <div class="author-meta">
                    <i class="bi bi-person"></i>
                    <span class="author-text">
                        {{ $strukturorgs->user->name }}
                    </span>
                    <span class="date-sep">·</span>
                    <span class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ $strukturorgs->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                    </span>
                    <span class="date-sep">·</span>
                    <span class="date-badge">
                        <i class="bi bi-clock"></i>
                        {{ $strukturorgs->created_at->format('H:i') }} WIB
                    </span>
                </div>
                @endif
            </div>
        </div>

        {{-- Deskripsi --}}
        @if($strukturorgs->deskripsi)
        <div class="so-body">
            <p class="so-body-label"> <i class="bi bi-person-badge"></i> Profil</p>
            <div class="article-body">
                {!! $strukturorgs->deskripsi !!}
            </div>
        </div>
        @endif

        {{-- Related --}}
        @if($related->count())
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">Tim RTPU</span>
                <h2 class="section-title mt-1">Tim RTPU Lainnya</h2>
            </div>
            <div class="row g-4">
                @foreach($related as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('struktur-organisasi.show', $item->slug) }}" class="person-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="person-photo">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                            @else
                                <div class="person-photo-placeholder">
                                    <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </div>
                        <div class="person-body">
                            <span class="person-jabatan">{{ $item->jabatan }}</span>
                            <h6 class="person-name">{{ $item->nama }}</h6>
                            {{-- @if($item->deskripsi)
                            <p class="person-desc">{{ Str::limit(html_entity_decode(strip_tags($item->deskripsi)), 100) }}</p>
                            @endif --}}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('struktur-organisasi.index') }}" class="btn-lihat-semua">
                    Lihat Semua Struktur Organisasi <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

    </div>
</section>

<style>
/* ─── Page ─── */
.so-page {
    padding: 3rem 0 5rem;
}

/* ─── Breadcrumb ─── */
.so-breadcrumb {
    margin-bottom: 2.5rem;
}
.breadcrumb-custom {
    background: none;
    padding: 0;
    margin: 0;
    font-size: 0.8rem;
    gap: 0;
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
    color: #e5e7eb;
    padding: 0 0.4rem;
}

/* ─── Hero ─── */
.so-hero {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 0;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 2.5rem;
    background: #fff;
}

.so-hero-photo {
    position: relative;
    overflow: hidden;
}
.so-hero-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    display: block;
    min-height: 280px;
}
.so-photo-placeholder {
    width: 100%;
    min-height: 280px;
    background: #f9fafb;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e5e7eb;
    font-size: 5rem;
}

.so-hero-body {
    padding: 2.25rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 0.6rem;
    border-left: 1px solid #f3f4f6;
}

.so-jabatan-chip {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    color: #00998a;
    background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.15);
    padding: 0.2rem 0.75rem;
    border-radius: 50px;
    width: fit-content;
    margin-bottom: 0.25rem;
}

.so-name {
    font-size: 1.65rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.025em;
    line-height: 1.25;
    margin: 0;
}

.so-institusi {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.82rem;
    font-weight: 500;
    color: #9ca3af;
    margin: 0;
}

.so-divider {
    width: 2.5rem;
    height: 1px;
    background: #e5e7eb;
    margin: 0.4rem 0;
}

/* ─── Author meta ─── */
.author-meta {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    margin-bottom: 1.25rem;
    flex-wrap: wrap;
    font-weight: 500;
    color: #9ca3af;
}
.author-meta .bi {
    font-size: 0.78rem;
    line-height: 1;
}
.author-text {
    font-size: 0.82rem;
    color: #9ca3af;
}
.date-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.78rem;
    font-weight: 500;
    color: #9ca3af;
}
.author-divider {
    border: none;
    border-top: 1px solid #f3f4f6;
    margin: 0 0 1.5rem;
}
.date-badge .bi { font-size: 0.78rem; line-height: 1; }
.date-sep { color: #d1d5db; font-size: 0.75rem; }

/* ─── Body / Deskripsi ─── */
.so-body {
    background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px; padding: 1.75rem;
}

.so-body-label {
    font-size: 1rem; font-weight: 700; color: #111827;
    letter-spacing: -0.01em; margin-bottom: 1rem;
    display: flex; align-items: center; gap: 0.5rem;
}

.so-body-label i {color: #00998a;}

.article-body {
    font-size: 1rem;
    line-height: 1.9;
    color: #374151;
    text-align: justify;
}
.article-body p { margin-bottom: 1.25rem; }
.article-body p:last-child { margin-bottom: 0; }
.article-body h2,
.article-body h3,
.article-body h4 {
    font-weight: 700;
    color: #111827;
    margin-top: 1.75rem;
    margin-bottom: 0.6rem;
}
.article-body a {
    color: #00998a;
    text-decoration: underline;
    text-underline-offset: 3px;
}
.article-body a:hover { color: #006b5e; }
.article-body blockquote {
    border-left: 3px solid #00998a;
    margin: 1.5rem 0;
    padding: 0.75rem 1.25rem;
    background: #f0fdfb;
    border-radius: 0 8px 8px 0;
    color: #4b5563;
    font-style: italic;
}

/* ─── Related ─── */
.related-section {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid #f3f4f6;
}
.related-header { margin-bottom: 1.75rem; }
.section-eyebrow {
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #00998a;
    background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18);
    padding: 0.2rem 0.75rem;
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

/* ─── Person card ─── */
.person-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    text-align: center;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.person-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.08);
    border-color: #e5e7eb;
}
.person-photo {
    width: 100%;
    aspect-ratio: 3 / 4;
    overflow: hidden;
    flex-shrink: 0;
}
.person-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    display: block;
}
.person-photo-placeholder {
    width: 100%;
    height: 100%;
    background: #f9fafb;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e5e7eb;
    font-size: 4rem;
}
.person-body {
    padding: 1.1rem 1rem 1.4rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    gap: 0.3rem;
}
.person-jabatan {
    display: inline-block;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #00998a;
    background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.15);
    padding: 0.16rem 0.65rem;
    border-radius: 50px;
}
.person-name {
    font-size: 0.9rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
    margin: 0;
}
.person-desc {
    font-size: 0.82rem;
    color: #9ca3af;
    line-height: 1.6;
    margin: 0;
}

/* ─── Lihat semua ─── */
.btn-lihat-semua {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.82rem;
    font-weight: 600;
    color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.3);
    background: transparent;
    padding: 0.5rem 1.4rem;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.btn-lihat-semua:hover {
    background: #e6f7f5;
    color: #006b5e;
    border-color: #00998a;
}

/* ─── Responsive ─── */
@media (max-width: 767.98px) {
    .so-hero {
        grid-template-columns: 1fr;
    }
 /* Hapus min-height & max-height, pakai aspect-ratio saja */
    .so-hero-photo {
        aspect-ratio: 3 / 4;
        height: auto;
    }

    .so-hero-photo img {
        min-height: unset;
        height: 100%;
    }

    .so-photo-placeholder {
        min-height: unset;
        height: 100%;
        aspect-ratio: 3 / 4;
    }

    .so-hero-body {
        border-left: none;
        border-top: 1px solid #f3f4f6;
        padding: 1.5rem;
    }
    .so-name { font-size: 1.35rem; }
    .so-body { padding: 1.5rem; }
}

@media (max-width: 575.98px) {
    .so-page { padding: 2rem 0 4rem; }
    .so-body { padding: 1.25rem; }
}
</style>

@endsection