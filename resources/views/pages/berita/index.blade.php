@extends('layouts.app')

@section('title', 'Berita - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Berita</li>
                </ol>
            </nav>
            {{-- <span class="section-eyebrow">Informasi</span> --}}
            <h1 class="section-title mt-1">Berita Terkini</h1>
            <p class="section-subtitle">Informasi dan berita terbaru seputar kegiatan RTPU Politeknik Negeri Jakarta.</p>
        </div>

        {{-- Berita Utama --}}
        @if($beritas->count() > 0)
            @php $utama = $beritas->first(); @endphp
            <div class="berita-utama mb-5">
                <div class="berita-utama-img">
                    <span class="card-chip">Berita Utama</span>
                    @if($utama->thumbnail)
                        <img src="{{ asset('storage/' . $utama->thumbnail) }}" alt="{{ $utama->judul }}">
                    @else
                        <div class="berita-utama-placeholder">
                            <i class="bi bi-newspaper"></i>
                        </div>
                    @endif
                </div>
                <div class="berita-utama-body">
                    <div class="date-badge mt-2 mb-3">
                        <i class="bi bi-calendar3"></i>
                        {{ $utama->created_at->translatedFormat('d F Y') }}
                        <span class="date-sep">·</span>
                        <i class="bi bi-clock"></i>
                        {{ $utama->created_at->format('H:i') }} WIB
                    </div>
                    <h2 class="berita-utama-title">
                        <a href="{{ route('berita.show', $utama->slug) }}"
                        >{{ Str::limit($utama->judul, 80) }}</a>
                    </h2>
                    <p class="berita-utama-excerpt">{{ Str::limit(html_entity_decode(strip_tags($utama->isi)), 200) }}</p>
                </div>
            </div>

            {{-- Grid Berita Lainnya --}}
            <div class="row g-4">
                @foreach($beritas->skip(1) as $berita)
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="content-card-thumb">
                            <span class="card-chip">Berita</span>
                            @if($berita->thumbnail)
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $berita->created_at->format('H:i') }} WIB
                            </div>
                            <h6 class="content-card-title">
                                <a href="{{ route('berita.show', $berita->slug) }}"
                                >{{ Str::limit($berita->judul, 65) }}</a>
                            </h6>
                            <p class="content-card-excerpt">{{ Str::limit(strip_tags($berita->isi), 110) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($beritas->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <div class="pagination-wrapper">
                    {{ $beritas->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        @else
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-megaphone"></i>
                    <p>Belum ada berita yang tersedia.</p>
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
    margin-bottom: 1.1rem;
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

/* ─── Page header ─── */
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
    font-size: 1.85rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin-bottom: 0.4rem;
}

.section-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin: 0;
    max-width: 520px;
}

/* ─── Berita Utama ─── */
.berita-utama {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    transition: box-shadow 0.22s ease, border-color 0.22s ease;
}

.berita-utama:hover {
    box-shadow: 0 12px 40px rgba(0,0,0,0.11);
    border-color: transparent;
}

.berita-utama-img {
    height: 320px;
    overflow: hidden;
    position: relative;
}

.berita-utama-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.35s ease;
}

.berita-utama:hover .berita-utama-img img {
    transform: scale(1.04);
}

.berita-utama-placeholder {
    width: 100%;
    height: 100%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 4rem;
}

.berita-utama-body {
    padding: 2rem 2.25rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.berita-utama-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.45;
    letter-spacing: -0.015em;
    margin: 0 0 0.75rem;
}

.berita-utama-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}

.berita-utama-title a:hover { color: #00998a; }

.berita-utama-excerpt {
    font-size: 0.9rem;
    color: #6b7280;
    line-height: 1.75;
    margin: 0;
}

@media (max-width: 767.98px) {
    .berita-utama {
        grid-template-columns: 1fr;
    }
    .berita-utama-img { height: 220px; }
    .berita-utama-body { padding: 1.5rem; }
}

/* ─── Content Card ─── */
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
    height: 190px;
    overflow: hidden;
    flex-shrink: 0;
    position: relative;
}

.content-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.35s ease;
}

.content-card:hover .content-card-thumb img { transform: scale(1.04); }

.content-card-thumb-placeholder {
    width: 100%;
    height: 100%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 2.5rem;
}

.content-card-body {
    padding: 1.25rem 1.35rem 1.5rem;
    display: flex;
    flex-direction: column;
    flex: 1;
}

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

.date-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.28rem;
    font-size: 0.73rem;
    font-weight: 500;
    color: #9ca3af;
}

.date-sep { opacity: 0.5; margin: 0 0.1rem; }

.content-card-title {
    font-size: 0.925rem;
    font-weight: 600;
    color: #111827;
    line-height: 1.45;
    letter-spacing: -0.01em;
    margin: 0 0 0.5rem;
}

.content-card-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}

.content-card-title a:hover { color: #00998a; }

.content-card-excerpt {
    font-size: 0.845rem;
    color: #6b7280;
    line-height: 1.65;
    margin: 0;
    flex: 1;
}

/* ─── Pagination ─── */
.pagination-wrapper .pagination {
    gap: 0.3rem;
    margin: 0;
}

.pagination-wrapper .page-link {
    font-family: "Poppins", sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    color: #374151;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px !important;
    padding: 0.45rem 0.85rem;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}

.pagination-wrapper .page-link:hover {
    background: #e6f7f5;
    color: #00998a;
    border-color: rgba(0,153,138,0.3);
}

.pagination-wrapper .page-item.active .page-link {
    background: #00998a;
    border-color: #00998a;
    color: #ffffff;
    font-weight: 600;
}

.pagination-wrapper .page-item.disabled .page-link {
    background: #f9fafb;
    color: #d1d5db;
    border-color: #e5e7eb;
}

/* ─── Empty state ─── */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #9ca3af;
}

.empty-state i {
    font-size: 3rem;
    display: block;
    margin-bottom: 0.85rem;
}

.empty-state p {
    margin: 0;
    font-size: 0.9rem;
}
</style>

@endsection