@extends('layouts.app')

@section('title', \App\Services\TranslateService::to($unitPut->nama_lengkap_unit_put, app()->getLocale()) . ' - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ \App\Services\TranslateService::to('Beranda', app()->getLocale()) }}</a></li>
                    <li class="breadcrumb-item active">{{ \App\Services\TranslateService::to('Pusat Unggulan', app()->getLocale()) }}</li>
                    <li class="breadcrumb-item active">{{ \App\Services\TranslateService::to($unitPut->nama_singkat_unit_put, app()->getLocale()) }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ \App\Services\TranslateService::to($unitPut->nama_lengkap_unit_put, app()->getLocale()) }}</h1>
            <p class="section-subtitle">
                <span class="put-abbr">({{ $unitPut->nama_singkat_unit_put }})</span>
            </p>
        </div>

        {{-- Thumbnail Profil (statis, selalu tampil) --}}
        @if($unitPut->thumbnail)
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="article-hero-img">
                    <img src="{{ asset('storage/' . $unitPut->thumbnail) }}"
                        alt="{{ $unitPut->nama_singkat_unit_put }}">
                </div>
            </div>
        </div>
        @endif

        {{-- Tab Pills (di bawah thumbnail/poster) --}}
        <ul class="nav nav-pills nav-pills-custom mb-4" id="unitPutTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profil-tab" data-bs-toggle="pill"
                        data-bs-target="#profil-pane" type="button" role="tab"
                        aria-controls="profil-pane" aria-selected="true">
                    1. {{ \App\Services\TranslateService::to('Profil', app()->getLocale()) }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="visimisi-tab" data-bs-toggle="pill"
                        data-bs-target="#visimisi-pane" type="button" role="tab"
                        aria-controls="visimisi-pane" aria-selected="false">
                    2. {{ \App\Services\TranslateService::to('Visi & Misi', app()->getLocale()) }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kebijakan-tab" data-bs-toggle="pill"
                        data-bs-target="#kebijakan-pane" type="button" role="tab"
                        aria-controls="kebijakan-pane" aria-selected="false">
                    3. {{ \App\Services\TranslateService::to('Dukungan Kebijakan', app()->getLocale()) }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sdm-tab" data-bs-toggle="pill"
                        data-bs-target="#sdm-pane" type="button" role="tab"
                        aria-controls="sdm-pane" aria-selected="false">
                    4. {{ \App\Services\TranslateService::to('Sumber Daya Manusia', app()->getLocale()) }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sarpras-tab" data-bs-toggle="pill"
                        data-bs-target="#sarpras-pane" type="button" role="tab"
                        aria-controls="sarpras-pane" aria-selected="false">
                    5. {{ \App\Services\TranslateService::to('Sarana & Prasarana', app()->getLocale()) }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="roadmap-tab" data-bs-toggle="pill"
                        data-bs-target="#roadmap-pane" type="button" role="tab"
                        aria-controls="roadmap-pane" aria-selected="false">
                    6. {{ \App\Services\TranslateService::to('Roadmap', app()->getLocale()) }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="struktur-tab" data-bs-toggle="pill"
                        data-bs-target="#struktur-pane" type="button" role="tab"
                        aria-controls="struktur-pane" aria-selected="false">
                    7. {{ \App\Services\TranslateService::to('Struktur Organisasi', app()->getLocale()) }}
                </button>
            </li>
        </ul>

        <div class="tab-content mb-5" id="unitPutTabContent">

            {{-- Pane: Profil (deskripsi) --}}
            <div class="tab-pane fade show active" id="profil-pane" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-building"></i>
                        {{ \App\Services\TranslateService::to('Tentang', app()->getLocale()) }} {{ \App\Services\TranslateService::to($unitPut->nama_singkat_unit_put, app()->getLocale()) }}
                    </h5>
                    @if($unitPut->deskripsi)
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($unitPut->deskripsi, app()->getLocale()) !!}
                    </div>
                    @else
                    <p class="text-muted mb-0">{{ \App\Services\TranslateService::to('Deskripsi belum tersedia.', app()->getLocale()) }}</p>
                    @endif
                </div>
            </div>

            {{-- Pane: Visi & Misi --}}
            <div class="tab-pane fade" id="visimisi-pane" role="tabpanel" aria-labelledby="visimisi-tab" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-flag"></i>
                        {{ \App\Services\TranslateService::to('Visi & Misi', app()->getLocale()) }}
                    </h5>
                    @if($unitPut->visi_misi)
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($unitPut->visi_misi, app()->getLocale()) !!}
                    </div>
                    @else
                    <p class="text-muted mb-0">{{ \App\Services\TranslateService::to('Visi & misi belum tersedia.', app()->getLocale()) }}</p>
                    @endif
                </div>
            </div>

            {{-- Pane: Dukungan Kebijakan --}}
            <div class="tab-pane fade" id="kebijakan-pane" role="tabpanel" aria-labelledby="kebijakan-tab" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-file-earmark-text"></i>
                        {{ \App\Services\TranslateService::to('Dukungan Aturan / Kebijakan', app()->getLocale()) }}
                    </h5>
                    @if($unitPut->dukungan_kebijakan)
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($unitPut->dukungan_kebijakan, app()->getLocale()) !!}
                    </div>
                    @else
                    <p class="text-muted mb-0">{{ \App\Services\TranslateService::to('Dukungan aturan/kebijakan belum tersedia.', app()->getLocale()) }}</p>
                    @endif
                </div>
            </div>

            {{-- Pane: SDM --}}
            <div class="tab-pane fade" id="sdm-pane" role="tabpanel" aria-labelledby="sdm-tab" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-people"></i>
                        {{ \App\Services\TranslateService::to('Sumber Daya Manusia', app()->getLocale()) }}
                    </h5>
                    @if($unitPut->sdm)
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($unitPut->sdm, app()->getLocale()) !!}
                    </div>
                    @else
                    <p class="text-muted mb-0">{{ \App\Services\TranslateService::to('Data SDM belum tersedia.', app()->getLocale()) }}</p>
                    @endif
                </div>
            </div>

            {{-- Pane: Sarana & Prasarana --}}
            <div class="tab-pane fade" id="sarpras-pane" role="tabpanel" aria-labelledby="sarpras-tab" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-building-gear"></i>
                        {{ \App\Services\TranslateService::to('Sarana & Prasarana', app()->getLocale()) }}
                    </h5>
                    @if($unitPut->sarana_prasarana)
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($unitPut->sarana_prasarana, app()->getLocale()) !!}
                    </div>
                    @else
                    <p class="text-muted mb-0">{{ \App\Services\TranslateService::to('Data sarana & prasarana belum tersedia.', app()->getLocale()) }}</p>
                    @endif
                </div>
            </div>

            {{-- Pane: Roadmap --}}
            <div class="tab-pane fade" id="roadmap-pane" role="tabpanel" aria-labelledby="roadmap-tab" tabindex="0">
                <h5 class="produk-desc-title mb-4">
                    <i class="bi bi-signpost-split"></i>
                    {{ \App\Services\TranslateService::to('Roadmap', app()->getLocale()) }}
                </h5>
                @if(!empty($unitPut->roadmap))
                <div class="roadmap-list">
                    @foreach($unitPut->roadmap as $item)
                    <div class="roadmap-item d-flex mb-4">
                        <div class="roadmap-year me-3">
                            <span class="badge">{{ $item['tahun'] }}</span>
                        </div>
                        <div class="roadmap-body">
                            <h6 class="mb-1">{{ \App\Services\TranslateService::to($item['tahap'], app()->getLocale()) }}</h6>
                            <div class="article-body">
                                {!! \App\Services\TranslateService::to($item['deskripsi_tahapan'], app()->getLocale()) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-signpost-split"></i>
                    <p>{{ \App\Services\TranslateService::to('Roadmap belum tersedia.', app()->getLocale()) }}</p>
                </div>
                @endif
            </div>

            {{-- Pane: Struktur Organisasi --}}
            <div class="tab-pane fade" id="struktur-pane" role="tabpanel" aria-labelledby="struktur-tab" tabindex="0">
                <h5 class="produk-desc-title mb-4">
                    <i class="bi bi-diagram-3"></i>
                    {{ \App\Services\TranslateService::to('Struktur Organisasi', app()->getLocale()) }}
                </h5>
                @if(!empty($unitPut->struktur_organisasi))
                <div class="slider-wrap">
                    <button class="slider-nav slider-nav-prev" onclick="slideGallery('strukturUnitPut', -1)">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <div class="slider-track" id="strukturUnitPut">
                        @foreach($unitPut->struktur_organisasi as $anggota)
                        <div class="slider-card slider-card-person">
                            <div class="person-photo">
                                @if(!empty($anggota['foto']))
                                <img src="{{ asset('storage/' . $anggota['foto']) }}" alt="{{ $anggota['nama'] }}">
                                @else
                                <div class="person-photo-placeholder">
                                    <i class="bi bi-person"></i>
                                </div>
                                @endif
                            </div>
                            <div class="person-body">
                                <span class="person-jabatan">{{ \App\Services\TranslateService::to($anggota['jabatan'], app()->getLocale()) }}</span>
                                <h6 class="person-name">{{ $anggota['nama'] }}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="slider-nav slider-nav-next" onclick="slideGallery('strukturUnitPut', 1)">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-diagram-3"></i>
                    <p>{{ \App\Services\TranslateService::to('Struktur organisasi belum tersedia.', app()->getLocale()) }}</p>
                </div>
                @endif
            </div>

        </div>

        {{-- Galeri Poster (statis, selalu tampil) --}}
        @if(!empty($unitPut->poster))
        @php
            $posters = is_array($unitPut->poster) ? $unitPut->poster : json_decode($unitPut->poster, true);
        @endphp
        @if(!empty($posters))
        <div class="slider-section mb-5">
            <h5 class="produk-desc-title mb-4">
                <i class="bi bi-images"></i> {{ \App\Services\TranslateService::to('Poster', app()->getLocale()) }} {{ \App\Services\TranslateService::to($unitPut->nama_singkat_unit_put, app()->getLocale()) }}
            </h5>
            <div class="slider-wrap">
                <button class="slider-nav slider-nav-prev" onclick="slideGallery('posterUnitPut', -1)">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div class="slider-track slider-track-portrait" id="posterUnitPut">
                    @foreach($posters as $i => $poster)
                    <div class="slider-card slider-card-portrait" onclick="openLightbox('{{ asset('storage/' . $poster) }}')">
                        <img src="{{ asset('storage/' . $poster) }}" alt="Poster {{ $unitPut->nama_singkat_unit_put }} {{ $i + 1 }}" loading="lazy">
                        <div class="slider-card-overlay">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="slider-nav slider-nav-next" onclick="slideGallery('posterUnitPut', 1)">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
        @endif
        @endif

        {{-- Preview Per Kategori (lintas semua sub kategori di dalamnya) --}}
        @foreach($kategoris as $kategori)
        @php $produks = $previewPerKategori[$kategori->id] ?? collect(); @endphp

        <div class="kategori-section">
            <div class="kategori-header">
                <div class="kategori-header-left">
                    <span class="section-eyebrow">{{ \App\Services\TranslateService::to('Kategori', app()->getLocale()) }}</span>
                    <h2 class="section-title mt-1">{{ \App\Services\TranslateService::to($kategori->nama_kategori, app()->getLocale()) }}</h2>
                </div>
                <a href="{{ route('put.kategori', [$unitPut->slug, $kategori->slug]) }}"
                   class="btn-lihat-semua">
                    {{ \App\Services\TranslateService::to('Lihat Semua', app()->getLocale()) }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                @php $subKategori = $produk->subKategoriProdukPut; @endphp
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
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="bi bi-box"></i>
                <p>{{ \App\Services\TranslateService::to('Belum ada produk untuk kategori ini.', app()->getLocale()) }}</p>
            </div>
            @endif
        </div>

        @if(!$loop->last)
        <div class="kategori-divider"></div>
        @endif

        @endforeach

    </div>
</section>

{{-- Lightbox --}}
<div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">
        <i class="bi bi-x-lg"></i>
    </button>
    <img src="" alt="" class="lightbox-img" id="lightboxImg"
         onclick="event.stopPropagation()">
</div>

<style>
.slider-wrap {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.slider-track {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    padding: 0.25rem 0.25rem 0.5rem;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.slider-track::-webkit-scrollbar {
    display: none;
}

.slider-card {
    flex: 0 0 auto;
    width: 320px;
    aspect-ratio: 16 / 9;
    scroll-snap-align: start;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    background: #f0f0f0;
}

.slider-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.slider-card:hover img {
    transform: scale(1.05);
}

.slider-card-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.25s ease;
    color: #fff;
    font-size: 1.5rem;
}

.slider-card:hover .slider-card-overlay {
    opacity: 1;
}

.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: none;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 2;
    transition: opacity 0.2s ease, visibility 0.2s ease;
}

.slider-nav-prev { left: -23px; }
.slider-nav-next { right: -23px; }

.slider-nav:hover {
    background: #f5f5f5;
}

.slider-nav.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

@media (max-width: 768px) {
    .slider-card { width: 240px; }
    .slider-nav { display: none; }
}

.slider-card-portrait {
    width: 220px;
    aspect-ratio: 3 / 4;
}

@media (max-width: 768px) {
    .slider-card-portrait { width: 170px; }
}

.roadmap-item .roadmap-year .badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.85rem;
    background-color: #00998a;
}
</style>

@include('pages.put._styles')

<script>
function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightboxOverlay').classList.remove('active');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLightbox();
});

function slideGallery(id, direction) {
    const track = document.getElementById(id);
    const cardWidth = track.querySelector('.slider-card')?.offsetWidth || 320;
    const gap = 16;
    track.scrollBy({ left: direction * (cardWidth + gap) * 2, behavior: 'smooth' });
}

function initSliderNav(trackId) {
    const track = document.getElementById(trackId);
    if (!track) return;

    const wrap = track.closest('.slider-wrap');
    const prevBtn = wrap.querySelector('.slider-nav-prev');
    const nextBtn = wrap.querySelector('.slider-nav-next');
    if (!prevBtn || !nextBtn) return;

    function updateNavState() {
        const canScroll = track.scrollWidth > track.clientWidth + 4;
        const atStart = track.scrollLeft <= 4;
        const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;

        if (!canScroll) {
            prevBtn.classList.add('is-hidden');
            nextBtn.classList.add('is-hidden');
            return;
        }

        prevBtn.classList.toggle('is-hidden', atStart);
        nextBtn.classList.toggle('is-hidden', atEnd);
    }

    updateNavState();
    track.addEventListener('scroll', updateNavState);
    window.addEventListener('resize', updateNavState);
}

document.addEventListener('DOMContentLoaded', () => {
    initSliderNav('posterUnitPut');
    initSliderNav('strukturUnitPut');
});

document.getElementById('struktur-tab')?.addEventListener('shown.bs.tab', () => {
    initSliderNav('strukturUnitPut');
});
</script>
@endsection