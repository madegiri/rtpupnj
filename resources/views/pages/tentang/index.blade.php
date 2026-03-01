@extends('layouts.app')

@section('title', 'Tentang RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tentang RTPU</li>
                </ol>
            </nav>
            {{-- <span class="section-eyebrow">Profil</span> --}}
            <h1 class="section-title mt-1">Tentang RTPU PNJ</h1>
        </div>

        <div class="row justify-content">
            <div class="text-center mb-5">
                @if($tentang && $tentang->logo)
                    <img src="{{ asset('storage/' . $tentang->logo) }}" alt="Logo RTPU PNJ" class="tentang-logo">
                @endif
            </div>
            <div class="col-lg-12">
                @if($tentang)
                    <div class="article-body">
                        {!! $tentang->isi !!}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-info-circle"></i>
                        <p>Informasi tentang RTPU belum tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

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
    margin-bottom: 0;
}

.tentang-logo {
    max-width: 230px;
    width: 100%;
    height: auto;
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
.article-body p  { margin-bottom: 1.35rem; }

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