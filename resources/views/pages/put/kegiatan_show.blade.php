@extends('layouts.app')

@section('title', \App\Services\TranslateService::to($kegiatan['judul'], app()->getLocale()) . ' - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content">
            <div class="col-lg-12">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ \App\Services\TranslateService::to('Beranda', app()->getLocale()) }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('put.index', $unitPut->slug) }}">{{ $unitPut->nama_singkat_unit_put }}</a></li>
                        <li class="breadcrumb-item active">{{ \App\Services\TranslateService::to($label, app()->getLocale()) }}</li>
                        <li class="breadcrumb-item active">{{ Str::limit(\App\Services\TranslateService::to($kegiatan['judul'], app()->getLocale()), 40) }}</li>
                    </ol>
                </nav>

                <h1 class="article-title">{{ \App\Services\TranslateService::to($kegiatan['judul'], app()->getLocale()) }}</h1>

                @php
                    $tanggal = !empty($kegiatan['created_at']) ? \Carbon\Carbon::parse($kegiatan['created_at']) : null;
                    $namaPembuat = $pembuat[$kegiatan['user_id'] ?? null] ?? null;
                @endphp
                @if($namaPembuat || $tanggal)
                <div class="article-meta">
                    @if($namaPembuat)
                    <span class="date-badge">
                        <i class="bi bi-person"></i>
                        {{ $namaPembuat }}
                    </span>
                    @endif

                    @if($tanggal)
                        @if($namaPembuat)
                        <span class="date-sep">·</span>
                        @endif
                        <span class="date-badge">
                            <i class="bi bi-calendar3"></i>
                            {{ $tanggal->locale(app()->getLocale())->isoFormat('D MMMM YYYY') }}
                        </span>
                        <span class="date-sep">·</span>
                        <span class="date-badge">
                            <i class="bi bi-clock"></i>
                            {{ $tanggal->format('H:i') }} {{ \App\Services\TranslateService::timezoneLabel() }}
                        </span>
                    @endif
                </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        @if(!empty($kegiatan['foto']))
                        <div class="article-hero-img">
                            <span class="card-chip">{{ \App\Services\TranslateService::to($label, app()->getLocale()) }}</span>
                            <img src="{{ asset('storage/' . $kegiatan['foto']) }}" alt="{{ $kegiatan['judul'] }}">
                        </div>
                        @endif
                    </div>
                </div>

                @if(!empty($kegiatan['isi']))
                <div class="produk-desc-box">
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($kegiatan['isi'], app()->getLocale()) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Kegiatan Terkait --}}
        @if($related->count())
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">{{ \App\Services\TranslateService::to('Baca Juga', app()->getLocale()) }}</span>
                <h2 class="section-title mt-1">{{ \App\Services\TranslateService::to($label, app()->getLocale()) }} {{ \App\Services\TranslateService::to('Lainnya', app()->getLocale()) }}</h2>
            </div>
            <div class="row g-4">
                @foreach($related as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('put.kegiatan', [$unitPut->slug, $jenis, $item['slug']]) }}"
                       class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ \App\Services\TranslateService::to($label, app()->getLocale()) }}</span>
                            @if(!empty($item['foto']))
                                <img src="{{ asset('storage/' . $item['foto']) }}" alt="{{ $item['judul'] }}">
                            @else
                                <div class="content-card-thumb-placeholder">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                            @endif
                        </div>
                        <div class="content-card-body">
                            @if(!empty($item['created_at']))
                            @php $tanggal = \Carbon\Carbon::parse($item['created_at']); @endphp
                            <div class="date-badge mt-1 mb-2">
                                <i class="bi bi-calendar3"></i>
                                {{ $tanggal->locale(app()->getLocale())->isoFormat('D MMMM YYYY') }}
                                <span class="date-sep">·</span>
                                <i class="bi bi-clock"></i>
                                {{ $tanggal->format('H:i') }} {{ \App\Services\TranslateService::timezoneLabel() }}
                            </div>
                            @endif

                            <h6 class="content-card-title">{{ Str::limit(\App\Services\TranslateService::to($item['judul'], app()->getLocale()), 65) }}</h6>
                            <p class="content-card-excerpt">{{ Str::limit(\App\Services\TranslateService::to(html_entity_decode(strip_tags($item['isi'] ?? '')), app()->getLocale()), 120) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('put.index', $unitPut->slug) }}" class="btn-lihat-semua">
                    {{ \App\Services\TranslateService::to('Kembali ke Profil', app()->getLocale()) }} {{ $unitPut->nama_singkat_unit_put }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

    </div>
</section>

{{-- Semua style (breadcrumb, article, content-card, related, dll) ada di partial ini --}}
@include('pages.put._styles')
@endsection