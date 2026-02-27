@extends('layouts.app')

@section('title', 'CAINT - Center for Artificial Internet of Things - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Pusat Unggulan Teknologi</li>
                    <li class="breadcrumb-item active">CAINT</li>
                </ol>
            </nav>
            {{-- <span class="section-eyebrow">Pusat Unggulan Teknologi</span> --}}
            <h1 class="section-title mt-1">Center for Artificial Internet of Things</h1>
            <p class="section-subtitle"><span class="put-abbr">(CAINT)</span></p>
        </div>

        @if($profil)
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($profil->thumbnail)
                <div class="article-hero-img">
                    <img src="{{ asset('storage/' . $profil->thumbnail) }}" alt="CAINT">
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- Profil --}}
        @if($profil)
        <div class="row justify-content mb-5">
            <div class="col-lg-12">

                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-building"></i> Tentang CAINT
                    </h5>
                    <div class="article-body">
                        {!! $profil->deskripsi !!}
                    </div>
                </div>

            </div>
        </div>
        @endif

        {{-- Preview per Kategori --}}
        @foreach($config as $nama => $cfg)
        @php $produks = $previewPerKategori[$nama]; @endphp

        <div class="kategori-section">
            {{-- Header Kategori --}}
            <div class="kategori-header">
                <div class="kategori-header-left">
                    <span class="section-eyebrow">Kategori</span>
                    <h2 class="section-title mt-1">{{ $nama }}</h2>
                    <p class="kategori-count">
                        <i class="bi bi-grid-3x3-gap"></i>
                        {{ $countPerKategori[$nama] ?? 0 }} produk tersedia
                    </p>
                </div>
                <a href="{{ route('caint.' . $cfg['slug'] . '.index') }}" class="btn-lihat-semua">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                <div class="col-md-4">
                    <div class="content-card h-100">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ $nama }}</span>
                            @if($produk->thumbnail)
                                <img src="{{ asset('storage/' . $produk->thumbnail) }}" alt="{{ $produk->judul }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi {{ $cfg['icon'] }}"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $produk->created_at->translatedFormat('d F Y') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $produk->created_at->format('H:i') }}
                            </div>
                            <h6 class="content-card-title">
                                <a href="{{ route('caint.' . $cfg['slug'] . '.show', $produk->slug) }}"
                                   >{{ Str::limit($produk->judul, 65) }}</a>
                            </h6>
                            <p class="content-card-excerpt">{{ Str::limit(strip_tags($produk->isi), 110) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="bi {{ $cfg['icon'] }}"></i>
                <p>Belum ada produk untuk kategori ini.</p>
            </div>
            @endif
        </div>

        @if(!$loop->last)
        <div class="kategori-divider"></div>
        @endif

        @endforeach

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
    font-size: clamp(1.5rem, 3vw, 1.85rem); font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 0.3rem;
}
.section-subtitle { margin: 0; }
.put-abbr { font-size: 1rem; font-weight: 600; color: #00998a; }

/* ─── Hero image ─── */
.article-hero-img {
    width: 100%; border-radius: 14px; overflow: hidden;
    margin-bottom: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08);
}
.article-hero-img img {
    width: 100%; max-height: 360px; object-fit: cover; display: block;
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

/* ─── Kategori section ─── */
.kategori-section { margin-bottom: 1rem; }

.kategori-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1.75rem;
}

.kategori-header-left { flex: 1; }

.kategori-count {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.8rem;
    color: #9ca3af;
    font-weight: 500;
    margin: 0.25rem 0 0;
}
.kategori-count i { font-size: 0.75rem; }

.btn-lihat-semua {
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-size: 0.82rem; font-weight: 600; color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35); background: transparent;
    padding: 0.42rem 1.1rem; border-radius: 50px; text-decoration: none; white-space: nowrap;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
    flex-shrink: 0;
}
.btn-lihat-semua:hover { background: #e6f7f5; color: #006b5e; border-color: #00998a; }

.kategori-divider {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 3.5rem 0;
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
.content-card-thumb { width: 100%; height: 200px; overflow: hidden; flex-shrink: 0; position: relative;}
.content-card-thumb img {
    width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.35s ease;
}
.content-card:hover .content-card-thumb img { transform: scale(1.04); }
.content-card-thumb-placeholder {
    width: 100%; height: 100%; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2.5rem;
}
.content-card-body {
    padding: 1.25rem 1.35rem 1.5rem; display: flex; flex-direction: column; flex: 1;
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
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.73rem; font-weight: 500; color: #9ca3af;
}
.content-card-title {
    font-size: 0.925rem; font-weight: 600; color: #111827;
    line-height: 1.45; letter-spacing: -0.01em; margin: 0 0 0.5rem;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}
.content-card-title a { color: inherit; text-decoration: none; transition: color 0.2s; }
.content-card-title a:hover { color: #00998a; }
.content-card-excerpt {
    font-size: 0.845rem; color: #6b7280; line-height: 1.65; margin: 0; flex: 1;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}

/* ─── Empty state ─── */
.empty-state {
    text-align: center; padding: 3rem 2rem;
    background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px;
    color: #9ca3af;
}
.empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.75rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }
</style>

@endsection