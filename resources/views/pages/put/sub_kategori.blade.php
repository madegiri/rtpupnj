@extends('layouts.app')

@section('title', $subKategori->nama_sub_kategori . ' - ' . $kategori->nama_kategori . ' - ' . $unitPut->nama_singkat_unit_put . ' RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        <div class="page-header mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('put.index', $unitPut->slug) }}">
                            {{ $unitPut->nama_singkat_unit_put }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('put.kategori', [$unitPut->slug, $kategori->slug]) }}">
                            {{ $kategori->nama_kategori }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $subKategori->nama_sub_kategori }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ $subKategori->nama_sub_kategori }}</h1>
            <p class="section-subtitle">
                Produk dan riset {{ $unitPut->nama_singkat_unit_put }}
                dalam kategori {{ $kategori->nama_kategori }} - sub kategori {{ $subKategori->nama_sub_kategori }}.
            </p>
        </div>

        {{-- Search Bar --}}
        <div class="search-wrapper mb-4">
            <form action="{{ route('put.sub_kategori', [$unitPut->slug, $kategori->slug, $subKategori->slug]) }}" method="GET">
                <div class="search-box">
                    <i class="bi bi-search search-icon"></i>
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        placeholder="Cari produk..."
                        value="{{ $search ?? '' }}"
                        autocomplete="off"
                    >
                    @if($search ?? false)
                        <a href="{{ route('put.sub_kategori', [$unitPut->slug, $kategori->slug, $subKategori->slug]) }}" class="search-clear">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>
            @if($search ?? false)
                <p class="search-result-info">
                    Menampilkan hasil untuk <strong>"{{ $search }}"</strong>
                </p>
            @endif
        </div>

        <div class="row g-4">
            @forelse($produks as $produk)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('put.show', [$unitPut->slug, $kategori->slug, $subKategori->slug, $produk->slug]) }}"
                   class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">{{ $subKategori->nama_sub_kategori }}</span>
                        @if($produk->thumbnail)
                            <img src="{{ asset('storage/' . $produk->thumbnail) }}"
                                 alt="{{ $produk->judul }}">
                        @else
                            <div class="content-card-thumb-placeholder">
                                <i class="bi bi-box"></i>
                            </div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $produk->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $produk->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($produk->judul, 80) }}
                        </h6>
                        <p class="content-card-excerpt">
                            {{ Str::limit(strip_tags($produk->isi), 100) }}
                        </p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-box"></i>
                    <p>Belum ada produk untuk sub kategori ini.</p>
                </div>
            </div>
            @endforelse
        </div>

        @if($produks->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <div class="pagination-wrapper">
                {{ $produks->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</section>

@include('pages.put._styles')
@endsection