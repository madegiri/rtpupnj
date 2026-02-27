@extends('layouts.app')

@section('title', 'Struktur Organisasi - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tentang.index') }}">Tentang</a></li>
                    <li class="breadcrumb-item active">Struktur Organisasi</li>
                </ol>
            </nav>
            {{-- <span class="section-eyebrow">Organisasi</span> --}}
            <h1 class="section-title mt-1">Struktur Organisasi</h1>
            <p class="section-subtitle">Struktur organisasi Rumah Teknologi dan Pusat Unggulan Politeknik Negeri Jakarta.</p>
        </div>

        @if($struktur)
        <div class="struktur-wrapper">
            <img src="{{ asset('storage/' . $struktur->gambar) }}"
                 alt="Struktur Organisasi RTPU PNJ">
            <div class="struktur-footer">
                <a href="{{ asset('storage/' . $struktur->gambar) }}"
                   target="_blank"
                   class="btn-lihat-penuh">
                    <i class="bi bi-arrows-fullscreen"></i> Lihat Ukuran Penuh
                </a>
            </div>
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-building"></i>
            <p>Struktur organisasi belum tersedia.</p>
        </div>
        @endif

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
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

/* ─── Page header ─── */
.section-eyebrow {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem; border-radius: 50px;
}
.section-title {
    font-size: 1.85rem; font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 0.4rem;
}
.section-subtitle { font-size: 0.95rem; color: #6b7280; margin: 0; max-width: 520px; }

/* ─── Struktur wrapper ─── */
.struktur-wrapper {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
}

.struktur-wrapper img {
    width: 100%;
    display: block;
    object-fit: contain;
}

.struktur-footer {
    padding: 1.25rem;
    border-top: 1px solid #e5e7eb;
    text-align: center;
    background: #ffffff;
}

.btn-lihat-penuh {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35);
    background: transparent;
    padding: 0.55rem 1.4rem;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}

.btn-lihat-penuh:hover {
    background: #e6f7f5;
    color: #006b5e;
    border-color: #00998a;
}

/* ─── Empty state ─── */
.empty-state { text-align: center; padding: 4rem 2rem; color: #9ca3af; }
.empty-state i { font-size: 3rem; display: block; margin-bottom: 0.85rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }
</style>

@endsection