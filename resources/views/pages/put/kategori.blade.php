@extends('layouts.app')

@section('title', \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) . ' - ' . $unitPut->nama_singkat_unit_put . ' RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ \App\Services\TranslateService::to('Beranda', app()->getLocale()) }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('put.index', $unitPut->slug) }}">
                            {{ $unitPut->nama_singkat_unit_put }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) }}</h1>
            <p class="section-subtitle">
                {{ \App\Services\TranslateService::to('Sub kategori dan produk', app()->getLocale()) }} {{ $unitPut->nama_singkat_unit_put }}
                {{ \App\Services\TranslateService::to('dalam kategori', app()->getLocale()) }} {{ \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) }}.
            </p>
        </div>

        {{-- Preview Per Sub Kategori --}}
        @forelse($subKategoris as $sub)
        @php $produks = $previewPerSubKategori[$sub->id] ?? collect(); @endphp

        <div class="kategori-section">
            <div class="kategori-header">
                <div class="kategori-header-left">
                    <span class="section-eyebrow">{{ \App\Services\TranslateService::to('Sub Kategori', app()->getLocale()) }}</span>
                    <h2 class="section-title mt-1">{{ \App\Services\TranslateService::to($sub->nama_sub_kategori, app()->getLocale()) }}</h2>
                </div>
                <a href="{{ route('put.sub_kategori', [$unitPut->slug, $kategori->slug, $sub->slug]) }}"
                class="btn-lihat-semua">
                    {{ \App\Services\TranslateService::to('Lihat Semua', app()->getLocale()) }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('put.show', [$unitPut->slug, $kategori->slug, $sub->slug, $produk->slug]) }}"
                       class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ \App\Services\TranslateService::to($sub->nama_sub_kategori, app()->getLocale()) }}</span>
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
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="bi bi-box"></i>
                <p>{{ \App\Services\TranslateService::to('Belum ada produk untuk sub kategori ini.', app()->getLocale()) }}</p>
            </div>
            @endif
        </div>

        @if(!$loop->last)
        <div class="kategori-divider"></div>
        @endif

        @empty
        <div class="empty-state">
            <i class="bi bi-grid-3x3-gap"></i>
            <p>{{ \App\Services\TranslateService::to('Belum ada sub kategori untuk kategori ini.', app()->getLocale()) }}</p>
        </div>
        @endforelse

    </div>
</section>

@include('pages.put._styles')
@endsection