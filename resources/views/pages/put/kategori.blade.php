@extends('layouts.app')

@section('title', $kategori->nama_kategori . ' - ' . $unitPut->nama_singkat_unit_put . ' RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('put.index', $unitPut->slug) }}">
                            {{ $unitPut->nama_singkat_unit_put }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $kategori->nama_kategori }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ $kategori->nama_kategori }}</h1>
            <p class="section-subtitle">
                Sub kategori dan produk {{ $unitPut->nama_singkat_unit_put }}
                dalam kategori {{ $kategori->nama_kategori }}.
            </p>
        </div>

        {{-- Preview Per Sub Kategori --}}
        @forelse($subKategoris as $sub)
        @php $produks = $previewPerSubKategori[$sub->id] ?? collect(); @endphp

        <div class="kategori-section">
            <div class="kategori-header">
                <div class="kategori-header-left">
                    <span class="section-eyebrow">Sub Kategori</span>
                    <h2 class="section-title mt-1">{{ $sub->nama_sub_kategori }}</h2>
                </div>
                <a href="{{ route('put.sub_kategori', [$unitPut->slug, $kategori->slug, $sub->slug]) }}"
                   class="btn-lihat-semua">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('put.show', [$unitPut->slug, $kategori->slug, $sub->slug, $produk->slug]) }}"
                       class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ $sub->nama_sub_kategori }}</span>
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
                                {{ $produk->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
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
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="bi bi-box"></i>
                <p>Belum ada produk untuk sub kategori ini.</p>
            </div>
            @endif
        </div>

        @if(!$loop->last)
        <div class="kategori-divider"></div>
        @endif

        @empty
        <div class="empty-state">
            <i class="bi bi-grid-3x3-gap"></i>
            <p>Belum ada sub kategori untuk kategori ini.</p>
        </div>
        @endforelse

    </div>
</section>

@include('pages.put._styles')
@endsection