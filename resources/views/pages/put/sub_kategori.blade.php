@extends('layouts.app')

@section('title', \App\Services\TranslateService::to($subKategori->nama_sub_kategori, app()->getLocale()) . ' - ' . \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) . ' - ' . $unitPut->nama_singkat_unit_put . ' RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        <div class="page-header mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ \App\Services\TranslateService::to('Beranda', app()->getLocale()) }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('put.index', $unitPut->slug) }}">
                            {{ $unitPut->nama_singkat_unit_put }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('put.kategori', [$unitPut->slug, $kategori->slug]) }}">
                            {{ \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ \App\Services\TranslateService::to($subKategori->nama_sub_kategori, app()->getLocale()) }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ \App\Services\TranslateService::to($subKategori->nama_sub_kategori, app()->getLocale()) }}</h1>
            <p class="section-subtitle">
                {{ \App\Services\TranslateService::to('Produk dan riset', app()->getLocale()) }} {{ $unitPut->nama_singkat_unit_put }}
                {{ \App\Services\TranslateService::to('dalam kategori', app()->getLocale()) }} {{ \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) }}
                - {{ \App\Services\TranslateService::to('sub kategori', app()->getLocale()) }} {{ \App\Services\TranslateService::to($subKategori->nama_sub_kategori, app()->getLocale()) }}.
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
                        placeholder="{{ \App\Services\TranslateService::to('Cari produk...', app()->getLocale()) }}"
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
                    {{ \App\Services\TranslateService::to('Menampilkan hasil untuk', app()->getLocale()) }} <strong>"{{ $search }}"</strong>
                </p>
            @endif
        </div>

        <div class="row g-4">
            @forelse($produks as $produk)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('put.show', [$unitPut->slug, $kategori->slug, $subKategori->slug, $produk->slug]) }}"
                   class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">{{ \App\Services\TranslateService::to($subKategori->nama_sub_kategori, app()->getLocale()) }}</span>
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
                            {{ $produk->created_at->locale(app()->getLocale())->isoFormat('D MMMM YYYY') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $produk->created_at->format('H:i') }} {{ \App\Services\TranslateService::timezoneLabel() }}
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit(\App\Services\TranslateService::to($produk->judul, app()->getLocale()), 80) }}
                        </h6>
                        <p class="content-card-excerpt">
                            {{ Str::limit(\App\Services\TranslateService::to(strip_tags($produk->isi), app()->getLocale()), 100) }}
                        </p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-box"></i>
                    <p>{{ \App\Services\TranslateService::to('Belum ada produk untuk sub kategori ini.', app()->getLocale()) }}</p>
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