@extends('layouts.app')

@section('title', 'Artikel Inovasi - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Artikel Inovasi</li>
                </ol>
            </nav>
            {{-- <span class="section-eyebrow">Terbaru</span> --}}
            <h1 class="section-title mt-1">Artikel Inovasi</h1>
            <p class="section-subtitle">Kumpulan artikel inovasi dari RTPU Politeknik Negeri Jakarta.</p>
        </div>

        {{-- Grid Artikel --}}
        <div class="row g-4">
            @forelse($artikels as $artikel)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('artikel-inovasi.show', $artikel->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">Artikel Inovasi</span>
                        @if($artikel->thumbnail)
                            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}">
                        @else
                            <div class="content-card-thumb-placeholder">
                                <i class="bi bi-file-text"></i>
                            </div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $artikel->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $artikel->created_at->format('H:i') }}
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($artikel->judul, 65) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($artikel->isi)), 120) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-newspaper"></i>
                    <p>Belum ada artikel inovasi yang tersedia.</p>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($artikels->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <div class="pagination-wrapper">
                {{ $artikels->links('pagination::bootstrap-5') }}
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

.breadcrumb-custom .breadcrumb-item a:hover {
    color: #006b5e;
}

.breadcrumb-custom .breadcrumb-item.active {
    color: #9ca3af;
    font-weight: 400;
}

.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: #d1d5db;
}

/* ─── Page header ─── */
.page-header .section-eyebrow {
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
    margin-bottom: 0.5rem;
}

.page-header .section-title {
    font-size: 1.85rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin-bottom: 0.4rem;
}

.page-header .section-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin: 0;
    max-width: auto;
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

/* .content-card:hover .content-card-thumb img {
    transform: scale(1.04);
} */

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

.date-sep {
    opacity: 0.5;
    margin: 0 0.1rem;
}

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

.content-card-title a:hover {
    color: #00998a;
}

.content-card-excerpt {
    font-size: 0.845rem;
    color: #6b7280;
    line-height: 1.65;
    margin: 0;
    flex: 1;
    text-align: justify;
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
</style>

@endsection