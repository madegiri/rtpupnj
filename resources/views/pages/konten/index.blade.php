@extends('layouts.app')

@section('title', $kategori->nama_kategori_konten . ' - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $kategori->nama_kategori_konten }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ $kategori->nama_kategori_konten }}</h1>
            <p class="section-subtitle">Informasi {{ strtolower($kategori->nama_kategori_konten) }} dari RTPU Politeknik Negeri Jakarta.</p>
        </div>

        {{-- Search Bar --}}
        <div class="search-wrapper mb-4">
            <form action="{{ route('konten.index', $kategori->slug) }}" method="GET">
                <div class="search-box">
                    <i class="bi bi-search search-icon"></i>
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="Cari {{ strtolower($kategori->nama_kategori_konten) }}..."
                        value="{{ $search ?? '' }}"
                        autocomplete="off"
                    >
                    @if($search)
                        <a href="{{ route('konten.index', $kategori->slug) }}" class="search-clear">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>

            @if($search)
                <p class="search-result-info">
                    Menampilkan hasil untuk <strong>"{{ $search }}"</strong>
                </p>
            @endif
        </div>

        {{-- Grid Konten --}}
        <div class="row g-4">
            @forelse($kontens as $item)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('konten.show', [$kategori->slug, $item->slug]) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">{{ $kategori->nama_kategori_konten }}</span>
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}">
                        @else
                            <div class="content-card-thumb-placeholder">
                                <i class="bi bi-file-text"></i>
                            </div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $item->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $item->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($item->judul, 65) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($item->isi)), 120) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-newspaper"></i>
                    <p>Belum ada {{ strtolower($kategori->nama_kategori_konten) }} yang tersedia.</p>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($kontens->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <div class="pagination-wrapper">
                {{ $kontens->links('pagination::bootstrap-5') }}
            </div>
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
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; font-weight: 400; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

/* ─── Page header ─── */
.page-header .section-title {
    font-size: 1.85rem; font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 0.4rem;
}
.page-header .section-subtitle {
    font-size: 0.95rem; color: #6b7280; margin: 0;
}

/* ─── Search ─── */
.search-box { position: relative; display: flex; align-items: center; }
.search-icon { position: absolute; left: 1rem; color: #9ca3af; font-size: 0.9rem; pointer-events: none; }
.search-input {
    width: 100%; padding: 0.65rem 2.8rem 0.65rem 2.6rem;
    border: 1px solid #e5e7eb; border-radius: 10px; font-size: 0.875rem;
    font-family: "Poppins", sans-serif; color: #111827; background: #ffffff;
    outline: none; transition: border-color 0.2s, box-shadow 0.2s;
}
.search-input:focus { border-color: #00998a; box-shadow: 0 0 0 3px rgba(0,153,138,0.1); }
.search-clear { position: absolute; right: 0.85rem; color: #9ca3af; font-size: 0.75rem; text-decoration: none; transition: color 0.2s; }
.search-clear:hover { color: #ef4444; }
.search-result-info { font-size: 0.82rem; color: #6b7280; margin-top: 0.6rem; margin-bottom: 0; }

/* ─── Content Card ─── */
.content-card {
    background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px;
    overflow: hidden; display: flex; flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.content-card:hover { transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,0.11); border-color: transparent; }
.content-card-thumb { width: 100%; height: 190px; overflow: hidden; flex-shrink: 0; position: relative; }
.content-card-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
.content-card-thumb-placeholder {
    width: 100%; height: 100%; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2.5rem;
}
.content-card-body { padding: 1.25rem 1.35rem 1.5rem; display: flex; flex-direction: column; flex: 1; }
.card-chip {
    position: absolute; top: 0.6rem; right: 0.6rem; z-index: 1;
    display: inline-block; font-size: 0.68rem; font-weight: 700;
    letter-spacing: 0.07em; text-transform: uppercase; color: #00998a;
    background: rgba(255,255,255,0.92); backdrop-filter: blur(4px);
    border: 1px solid rgba(0,153,138,0.2); padding: 0.16rem 0.6rem; border-radius: 50px;
    max-width: calc(100% - 1.2rem); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.date-badge { display: inline-flex; align-items: center; gap: 0.28rem; font-size: 0.73rem; font-weight: 500; color: #9ca3af; }
.date-sep { opacity: 0.5; margin: 0 0.1rem; }
.content-card-title { font-size: 0.925rem; font-weight: 600; color: #111827; line-height: 1.45; letter-spacing: -0.01em; margin: 0 0 0.5rem; }
.content-card-excerpt { font-size: 0.845rem; color: #6b7280; line-height: 1.65; margin: 0; flex: 1; text-align: justify; }

/* ─── Empty state ─── */
.empty-state { text-align: center; padding: 4rem 2rem; color: #9ca3af; }
.empty-state i { font-size: 3rem; display: block; margin-bottom: 0.85rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }

/* ─── Pagination ─── */
.pagination-wrapper .pagination { gap: 0.3rem; margin: 0; }
.pagination-wrapper .page-link {
    font-family: "Poppins", sans-serif; font-size: 0.85rem; font-weight: 500;
    color: #374151; background: #ffffff; border: 1px solid #e5e7eb;
    border-radius: 8px !important; padding: 0.45rem 0.85rem;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.pagination-wrapper .page-link:hover { background: #e6f7f5; color: #00998a; border-color: rgba(0,153,138,0.3); }
.pagination-wrapper .page-item.active .page-link { background: #00998a; border-color: #00998a; color: #ffffff; font-weight: 600; }
.pagination-wrapper .page-item.disabled .page-link { background: #f9fafb; color: #d1d5db; border-color: #e5e7eb; }
.pagination-wrapper p { display: none !important; }
</style>

@endsection