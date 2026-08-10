@extends('layouts.app')

@section('title', $profil->nama_pekan_inovasi . ' - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Pekan Inovasi</li>
                    <li class="breadcrumb-item active">{{ $profil->nama_pekan_inovasi }}</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">{{ $profil->nama_pekan_inovasi }}</h1>
        </div>

        {{-- Thumbnail Profil --}}
        @if($profil->thumbnail)
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="article-hero-img">
                    <img src="{{ asset('storage/' . $profil->thumbnail) }}"
                         alt="{{ $profil->nama_pekan_inovasi }}">
                </div>
            </div>
        </div>
        @endif

        {{-- Deskripsi Profil --}}
        @if($profil->deskripsi)
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-calendar-event"></i>
                        Tentang {{ $profil->nama_pekan_inovasi }}
                    </h5>
                    <div class="article-body">
                        {!! $profil->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Galeri Kegiatan --}}
        @if(!empty($profil->galeri_kegiatan))
        <div class="slider-section mb-5">
            <h5 class="produk-desc-title mb-4">
                <i class="bi bi-images"></i> Galeri Kegiatan {{ $profil->nama_pekan_inovasi }}
            </h5>
            <div class="slider-wrap">
                <button class="slider-nav slider-nav-prev" onclick="slideGallery('galeriKegiatan', -1)">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="slider-track" id="galeriKegiatan">
                    @foreach($profil->galeri_kegiatan as $i => $foto)
                    <div class="slider-card" onclick="openLightbox('{{ asset('storage/' . $foto) }}')">
                        <img src="{{ asset('storage/' . $foto) }}" alt="Galeri Kegiatan {{ $i + 1 }}" loading="lazy">
                        <div class="slider-card-overlay">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="slider-nav slider-nav-next" onclick="slideGallery('galeriKegiatan', 1)">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
        @endif

        {{-- Galeri Poster Produk --}}
        @if(!empty($profil->poster))
        <div class="slider-section mb-5">
            <h5 class="produk-desc-title mb-4">
                <i class="bi bi-file-earmark-image"></i> Poster Pameran Produk {{ $profil->nama_pekan_inovasi }}
            </h5>
            <div class="slider-wrap">
                <button class="slider-nav slider-nav-prev" onclick="slideGallery('posterProduk', -1)">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="slider-track slider-track-portrait" id="posterProduk">
                    @foreach($profil->poster as $i => $poster)
                    <div class="slider-card slider-card-portrait" onclick="openLightbox('{{ asset('storage/' . $poster) }}')">
                        <img src="{{ asset('storage/' . $poster) }}" alt="Poster {{ $profil->nama_pekan_inovasi }} {{ $i + 1 }}" loading="lazy">
                        <div class="slider-card-overlay">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="slider-nav slider-nav-next" onclick="slideGallery('posterProduk', 1)">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
        @endif

        {{-- Preview Per Kategori --}}
        @foreach($kategoris as $kategori)
        @php $produks = $previewPerKategori[$kategori->id] ?? collect(); @endphp

        <div class="kategori-section">
            <div class="kategori-header">
                <div class="kategori-header-left">
                    <span class="section-eyebrow">Kategori</span>
                    <h2 class="section-title mt-1">{{ $kategori->nama_kategori }}</h2>
                </div>
                <a href="{{ route('pekan-inovasi.kategori', [$profil->slug, $kategori->slug]) }}"
                   class="btn-lihat-semua">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('pekan-inovasi.show', [$profil->slug, $kategori->slug, $produk->slug]) }}"
                       class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ $kategori->nama_kategori }}</span>
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
    /* sembunyikan scrollbar - Firefox */
    scrollbar-width: none;
    /* sembunyikan scrollbar - IE/Edge lama */
    -ms-overflow-style: none;
}

/* sembunyikan scrollbar - Chrome, Safari, Edge (Chromium) */
.slider-track::-webkit-scrollbar {
    display: none;
}

.slider-card {
    flex: 0 0 auto;
    width: 320px;
    aspect-ratio: 16 / 9;   /* landscape, konsisten */
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

.slider-nav-prev {
    left: -23px;
}

.slider-nav-next {
    right: -23px;
}

.slider-nav:hover {
    background: #f5f5f5;
}

.slider-nav.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

/* Responsive: card lebih kecil & tombol nav disembunyikan di HP (geser pakai jari) */
@media (max-width: 768px) {
    .slider-card {
        width: 240px;
    }
    .slider-nav {
        display: none;
    }
}

.slider-card-portrait {
    width: 220px;
    aspect-ratio: 3 / 4;   /* portrait, sesuai proporsi poster A4/A3 pada umumnya */
}

@media (max-width: 768px) {
    .slider-card-portrait {
        width: 170px;
    }
}
</style>

{{-- Lightbox --}}
<div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">
        <i class="bi bi-x-lg"></i>
    </button>
    <img src="" alt="" class="lightbox-img" id="lightboxImg"
         onclick="event.stopPropagation()">
</div>

@include('pages.pekan-inovasi._styles')

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

// ==== Auto show/hide chevron ====
function initSliderNav(trackId) {
    const track = document.getElementById(trackId);
    if (!track) return;

    const wrap = track.closest('.slider-wrap');
    const prevBtn = wrap.querySelector('.slider-nav-prev');
    const nextBtn = wrap.querySelector('.slider-nav-next');
    if (!prevBtn || !nextBtn) return;

    function updateNavState() {
        const canScroll = track.scrollWidth > track.clientWidth + 4; // toleransi rounding
        const atStart = track.scrollLeft <= 4;
        const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;

        // kalau semua foto sudah muat, sembunyikan kedua panah
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
    initSliderNav('galeriKegiatan');
    initSliderNav('posterProduk');
});
</script>
@endsection