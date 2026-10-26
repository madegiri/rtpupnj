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
                    <li class="breadcrumb-item active">{{ $unitPut->nama_singkat_unit_put }}</li>
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
            <li class="nav-item dropdown" role="presentation">
                <button class="nav-link dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    8. {{ \App\Services\TranslateService::to('Kegiatan', app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu">
                    @foreach([
                        ['penelitian', 'Penelitian'],
                        ['pengabdian', 'Pengabdian Masyarakat'],
                        ['lecturer', 'Lecturer Series'],
                        ['magang', 'Magang Riset'],
                        ['lainnya', 'Kegiatan Lainnya'],
                    ] as [$key, $label])
                    <li>
                        <button class="dropdown-item" type="button" role="tab"
                                data-bs-toggle="pill" data-bs-target="#{{ $key }}-pane"
                                aria-controls="{{ $key }}-pane" aria-selected="false">
                            {{ \App\Services\TranslateService::to($label, app()->getLocale()) }}
                        </button>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>

        <div class="tab-content mb-5" id="unitPutTabContent">

            {{-- Pane: Profil (deskripsi) --}}
            <div class="tab-pane fade show active" id="profil-pane" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-building"></i>
                        {{ \App\Services\TranslateService::to('Tentang', app()->getLocale()) }} {{ $unitPut->nama_singkat_unit_put }}
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
                <h5 class="produk-desc-title mb-3">
                    <i class="bi bi-file-earmark-text"></i>
                    {{ \App\Services\TranslateService::to('Dukungan Aturan / Kebijakan', app()->getLocale()) }}
                </h5>
                @if($unitPut->dukungan_kebijakan)
                @php $pdfUrl = asset('storage/' . $unitPut->dukungan_kebijakan); @endphp
                <div class="pdfjs-viewer" id="pdfViewer" data-url="{{ $pdfUrl }}">
                    <div class="pdfjs-toolbar">
                        <div class="pdfjs-group">
                            <button type="button" id="pdfPrev" title="Halaman sebelumnya"><i class="bi bi-chevron-up"></i></button>
                            <button type="button" id="pdfNext" title="Halaman berikutnya"><i class="bi bi-chevron-down"></i></button>
                            <span class="pdfjs-pageinfo">
                                <input type="number" id="pdfPageInput" min="1" value="1" aria-label="Nomor halaman">
                                / <span id="pdfPageCount">–</span>
                            </span>
                        </div>
                        <div class="pdfjs-group">
                            <button type="button" id="pdfZoomOut" title="Perkecil"><i class="bi bi-zoom-out"></i></button>
                            <span class="pdfjs-zoomlabel" id="pdfZoomLabel">100%</span>
                            <button type="button" id="pdfZoomIn" title="Perbesar"><i class="bi bi-zoom-in"></i></button>
                            <button type="button" id="pdfFit" title="Sesuaikan lebar"><i class="bi bi-arrows-expand-vertical" style="transform:rotate(90deg)"></i></button>
                            <a href="{{ $pdfUrl }}" download title="Unduh PDF" class="pdfjs-btn-link"><i class="bi bi-download"></i></a>
                        </div>
                    </div>
                    <div class="pdfjs-scroll" id="pdfScroll">
                        <div class="pdfjs-loading" id="pdfLoading">{{ \App\Services\TranslateService::to('Memuat dokumen…', app()->getLocale()) }}</div>
                    </div>
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-file-earmark-text"></i>
                    <p>{{ \App\Services\TranslateService::to('Dukungan aturan/kebijakan belum tersedia.', app()->getLocale()) }}</p>
                </div>
                @endif
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
                <h5 class="produk-desc-title mb-4">
                    <i class="bi bi-building-gear"></i>
                    {{ \App\Services\TranslateService::to('Sarana & Prasarana', app()->getLocale()) }}
                </h5>
                @if(!empty($unitPut->sarana_prasarana))
                @foreach($unitPut->sarana_prasarana as $sarpras)
                    @php
                        $fotos   = array_values(array_filter((array) ($sarpras['foto'] ?? [])));
                        $trackId = 'sarprasTrack-' . $loop->index;
                    @endphp
                    @if(!empty($fotos))
                    <div class="sarpras-group">
                        @if(!empty($sarpras['nama']))
                        <h6 class="sarpras-group-title">
                            {{ \App\Services\TranslateService::to($sarpras['nama'], app()->getLocale()) }}
                        </h6>
                        @endif

                        <div class="slider-wrap">
                            <button class="slider-nav slider-nav-prev" type="button" onclick="slideGallery('{{ $trackId }}', -1)">
                                <i class="bi bi-chevron-left"></i>
                            </button>

                            <div class="slider-track" id="{{ $trackId }}">
                                @foreach($fotos as $foto)
                                <div class="slider-card" onclick="openLightbox('{{ asset('storage/' . $foto) }}')">
                                    <img src="{{ asset('storage/' . $foto) }}" alt="{{ $sarpras['nama'] ?? '' }}" loading="lazy">
                                    <div class="slider-card-overlay">
                                        <i class="bi bi-zoom-in"></i>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button class="slider-nav slider-nav-next" type="button" onclick="slideGallery('{{ $trackId }}', 1)">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    @endif
                @endforeach
                @else
                <div class="empty-state">
                    <i class="bi bi-building-gear"></i>
                    <p>{{ \App\Services\TranslateService::to('Data sarana & prasarana belum tersedia.', app()->getLocale()) }}</p>
                </div>
                @endif
            </div>

            {{-- Pane: Roadmap --}}
            <div class="tab-pane fade" id="roadmap-pane" role="tabpanel" aria-labelledby="roadmap-tab" tabindex="0">
                <h5 class="produk-desc-title mb-4">
                    <i class="bi bi-signpost-split"></i>
                    {{ \App\Services\TranslateService::to('Roadmap', app()->getLocale()) }}
                </h5>
                @if($unitPut->roadmap)
                <div class="article-hero-img" style="cursor:zoom-in"
                     onclick="openLightbox('{{ asset('storage/' . $unitPut->roadmap) }}')">
                    <img src="{{ asset('storage/' . $unitPut->roadmap) }}" alt="Roadmap {{ $unitPut->nama_singkat_unit_put }}">
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
                @if($unitPut->struktur_organisasi)
                <div class="article-hero-img" style="cursor:zoom-in"
                     onclick="openLightbox('{{ asset('storage/' . $unitPut->struktur_organisasi) }}')">
                    <img src="{{ asset('storage/' . $unitPut->struktur_organisasi) }}" alt="Struktur Organisasi {{ $unitPut->nama_singkat_unit_put }}">
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-diagram-3"></i>
                    <p>{{ \App\Services\TranslateService::to('Struktur organisasi belum tersedia.', app()->getLocale()) }}</p>
                </div>
                @endif
            </div>

            {{-- BARU: Pane Penelitian --}}
            <div class="tab-pane fade" id="penelitian-pane" role="tabpanel" tabindex="0">
                @php
                    $penelitian = $unitPut->penelitian ?? [];
                    $roadmapImg = $penelitian['roadmap_gambar'] ?? null;
                    $publikasi  = $penelitian['publikasi'] ?? [];

                    // Sesuaikan path logo dengan file di folder public/
                    $linkLogos = [
                        'link_sinta'          => ['img' => 'logo-publikasi/sinta.jpg',          'label' => 'SINTA'],
                        'link_google_scholar' => ['img' => 'logo-publikasi/google-scholar.webp', 'label' => 'Google Scholar'],
                        'link_orcid'          => ['img' => 'logo-publikasi/orcid.webp',          'label' => 'ORCID'],
                    ];
                @endphp

                <h5 class="produk-desc-title mb-3">
                    <i class="bi bi-search"></i>
                    {{ \App\Services\TranslateService::to('Roadmap Penelitian', app()->getLocale()) }}
                </h5>
                @if($roadmapImg)
                    <div class="article-hero-img" style="cursor:zoom-in"
                         onclick="openLightbox('{{ asset('storage/' . $roadmapImg) }}')">
                        <img src="{{ asset('storage/' . $roadmapImg) }}" alt="Roadmap Penelitian {{ $unitPut->nama_singkat_unit_put }}">
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-signpost-split"></i>
                        <p>{{ \App\Services\TranslateService::to('Roadmap penelitian belum tersedia.', app()->getLocale()) }}</p>
                    </div>
                @endif

                <h5 class="produk-desc-title mt-4 mb-3">
                    <i class="bi bi-journal-richtext"></i>
                    {{ \App\Services\TranslateService::to('Publikasi', app()->getLocale()) }}
                </h5>
                @if(!empty($publikasi))
                    <div class="slider-wrap">
                        <button class="slider-nav slider-nav-prev" type="button" onclick="slideGallery('pubTrack', -1)">
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <div class="slider-track slider-track-pub" id="pubTrack">
                            @foreach($publikasi as $pub)
                            <div class="pub-slide">
                                <div class="pub-card">
                                    <div class="pub-card-photo">
                                        @if(!empty($pub['foto']))
                                            <img src="{{ asset('storage/' . $pub['foto']) }}" alt="{{ $pub['nama'] ?? '' }}" loading="lazy">
                                        @else
                                            <div class="person-photo-placeholder"><i class="bi bi-person"></i></div>
                                        @endif
                                    </div>
                                    <div class="pub-card-body">
                                        <h6 class="pub-card-name">{{ $pub['nama'] ?? '' }}</h6>
                                        <div class="pub-card-links">
                                            @foreach($linkLogos as $field => $logo)
                                                @if(!empty($pub[$field]))
                                                <a href="{{ $pub[$field] }}" target="_blank" rel="noopener noreferrer" title="{{ $logo['label'] }}">
                                                    <img src="{{ asset($logo['img']) }}" alt="{{ $logo['label'] }}">
                                                </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button class="slider-nav slider-nav-next" type="button" onclick="slideGallery('pubTrack', 1)">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-journal-richtext"></i>
                        <p>{{ \App\Services\TranslateService::to('Publikasi belum tersedia.', app()->getLocale()) }}</p>
                    </div>
                @endif
            </div>

            {{-- BARU: Pane Pengabdian Masyarakat --}}
            <div class="tab-pane fade" id="pengabdian-pane" role="tabpanel" tabindex="0">
                <h5 class="produk-desc-title mb-4">
                    <i class="bi bi-heart-pulse"></i>
                    {{ \App\Services\TranslateService::to('Pengabdian Masyarakat', app()->getLocale()) }}
                </h5>
                @include('pages.put._kegiatan-list', [
                    'items' => $unitPut->pengabdian_masyarakat,
                    'jenis' => 'pengabdian-masyarakat',
                    'empty' => 'Data pengabdian masyarakat belum tersedia.',
                ])
            </div>

            {{-- BARU: Pane Lecturer Series --}}
            <div class="tab-pane fade" id="lecturer-pane" role="tabpanel" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-mortarboard"></i>
                        {{ \App\Services\TranslateService::to('Lecturer Series', app()->getLocale()) }}
                    </h5>
                    @if($unitPut->lecturer_series)
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($unitPut->lecturer_series, app()->getLocale()) !!}
                    </div>
                    @else
                    <p class="text-muted mb-0">{{ \App\Services\TranslateService::to('Data lecturer series belum tersedia.', app()->getLocale()) }}</p>
                    @endif
                </div>
            </div>

            {{-- BARU: Pane Magang Riset --}}
            <div class="tab-pane fade" id="magang-pane" role="tabpanel" tabindex="0">
                <div class="produk-desc-box">
                    <h5 class="produk-desc-title">
                        <i class="bi bi-briefcase"></i>
                        {{ \App\Services\TranslateService::to('Topik Penelitian yang Sedang Berjalan di Kampus', app()->getLocale()) }}
                    </h5>
                    @if($unitPut->magang_riset)
                    <div class="article-body">
                        {!! \App\Services\TranslateService::to($unitPut->magang_riset, app()->getLocale()) !!}
                    </div>
                    @else
                    <p class="text-muted mb-0">{{ \App\Services\TranslateService::to('Data magang riset belum tersedia.', app()->getLocale()) }}</p>
                    @endif
                </div>
            </div>

            {{-- BARU: Pane Kegiatan Lainnya --}}
            <div class="tab-pane fade" id="lainnya-pane" role="tabpanel" tabindex="0">
                <h5 class="produk-desc-title mb-4">
                    <i class="bi bi-calendar-event"></i>
                    {{ \App\Services\TranslateService::to('Kegiatan Lainnya', app()->getLocale()) }}
                </h5>
                @include('pages.put._kegiatan-list', [
                    'items' => $unitPut->kegiatan_lainnya,
                    'jenis' => 'kegiatan-lainnya',
                    'empty' => 'Data kegiatan lainnya belum tersedia.',
                ])
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
                <i class="bi bi-images"></i> {{ \App\Services\TranslateService::to('Poster', app()->getLocale()) }} {{ $unitPut->nama_singkat_unit_put }}
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

.pdfjs-viewer {
    border: 1px solid #dee2e6;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    display: flex;
    flex-direction: column;
    height: 80vh;
    min-height: 500px;
}
.pdfjs-toolbar {
    display: flex;
    flex-wrap: nowrap;              
    align-items: center;
    justify-content: space-between;
    gap: .75rem;
    padding: .5rem .75rem;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    overflow-x: auto;               
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.pdfjs-toolbar::-webkit-scrollbar { display: none; }
.pdfjs-group {
    display: flex;
    align-items: center;
    gap: .35rem;
    flex: 0 0 auto;                 
    white-space: nowrap;
}
.pdfjs-toolbar button,
.pdfjs-btn-link,
.pdfjs-pageinfo,
.pdfjs-zoomlabel {
    flex: 0 0 auto;
}
.pdfjs-toolbar button,
.pdfjs-btn-link {
    width: 34px; height: 34px;
    border: 1px solid #dee2e6;
    background: #fff;
    border-radius: 8px;
    display: inline-flex; align-items: center; justify-content: center;
    color: #333; cursor: pointer; text-decoration: none;
}
.pdfjs-toolbar button:hover,
.pdfjs-btn-link:hover { background: #eef1f4; }
.pdfjs-pageinfo { font-size: .9rem; display: inline-flex; align-items: center; gap: .35rem; margin-left: .35rem; }
.pdfjs-pageinfo input {
    width: 56px; text-align: center;
    border: 1px solid #dee2e6; border-radius: 6px; padding: .2rem;
}
.pdfjs-zoomlabel { min-width: 48px; text-align: center; font-size: .9rem; }
.pdfjs-scroll {
    position: relative;           
    flex: 1;
    overflow: auto;
    background: #525659;
    padding: 12px 0;
}
.pdfjs-page {
    margin: 0 auto 12px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,.35);
}
.pdfjs-page canvas { display: block; }
.pdfjs-loading { color: #fff; text-align: center; padding: 2rem; }
@media (max-width: 576px) {
    .pdfjs-viewer { height: 70vh; }
    .pdfjs-toolbar { justify-content: flex-start; }
    .pdfjs-group + .pdfjs-group {
        padding-left: .75rem;
        border-left: 1px solid #dee2e6;
    }
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
    const cardWidth = track.firstElementChild?.offsetWidth || 320;
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
    track._updateNav = updateNavState;
    track.addEventListener('scroll', updateNavState);
    window.addEventListener('resize', updateNavState);
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.slider-track[id]').forEach(t => initSliderNav(t.id));

    if (window.bootstrap) {
        document.querySelectorAll('#unitPutTab .dropdown-toggle').forEach(el => {
            bootstrap.Dropdown.getOrCreateInstance(el, {
                popperConfig: (def) => ({ ...def, strategy: 'fixed' })
            });
        });
    }
});

document.addEventListener('shown.bs.tab', (e) => {
    const parent = e.target.closest('.dropdown');
    document.querySelectorAll('#unitPutTab .dropdown-toggle').forEach(tg => {
        tg.classList.toggle('active', !!parent && parent === tg.closest('.dropdown'));
    });

    document.querySelectorAll('.slider-track').forEach(t => t._updateNav && t._updateNav());
});
</script>

@if($unitPut->dukungan_kebijakan)
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
(function () {
    const viewer = document.getElementById('pdfViewer');
    if (!viewer || !window.pdfjsLib) return;

    pdfjsLib.GlobalWorkerOptions.workerSrc =
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    const url       = viewer.dataset.url;
    const scroller  = document.getElementById('pdfScroll');
    const pageInput = document.getElementById('pdfPageInput');
    const pageCount = document.getElementById('pdfPageCount');
    const zoomLabel = document.getElementById('pdfZoomLabel');

    let doc = null, base = null, scale = 1, fitMode = true;
    let current = 1, pages = [], observer = null, jobCounter = 0;

    const fitScale = () => Math.max(0.3, (scroller.clientWidth - 24) / base.width);

    async function init() {
        try {
            doc  = await pdfjsLib.getDocument(url).promise;
            base = (await doc.getPage(1)).getViewport({ scale: 1 });
            pageCount.textContent = doc.numPages;
            pageInput.max = doc.numPages;
            scale = fitScale();
            build(1);
        } catch (err) {
            console.error(err);
            scroller.innerHTML =
                '<div class="pdfjs-loading">Gagal memuat dokumen. ' +
                '<a href="' + url + '" target="_blank" rel="noopener" style="color:#fff;text-decoration:underline">Buka PDF langsung</a></div>';
        }
    }

    function build(goTo) {
        if (observer) observer.disconnect();
        scroller.innerHTML = '';
        pages = [];

        observer = new IntersectionObserver((entries) => {
            entries.forEach(en => en.isIntersecting ? renderPage(en.target) : freePage(en.target));
        }, { root: scroller, rootMargin: '600px 0px' });

        const frag = document.createDocumentFragment();
        for (let i = 1; i <= doc.numPages; i++) {
            const el = document.createElement('div');
            el.className = 'pdfjs-page';
            el.dataset.page = i;
            el.style.width  = Math.floor(base.width * scale) + 'px';
            el.style.height = Math.floor(base.height * scale) + 'px';
            pages.push(el);
            frag.appendChild(el);
        }
        scroller.appendChild(frag);
        pages.forEach(el => observer.observe(el));

        zoomLabel.textContent = Math.round(scale * 100) + '%';
        goToPage(goTo || 1);
    }

    async function renderPage(el) {
        if (el._job) return;
        const job = el._job = ++jobCounter;
        try {
            const page = await doc.getPage(parseInt(el.dataset.page, 10));
            const dpr  = Math.min(window.devicePixelRatio || 1, 2);
            const vp   = page.getViewport({ scale: scale * dpr });

            const canvas = document.createElement('canvas');
            canvas.width  = vp.width;
            canvas.height = vp.height;
            canvas.style.width  = (vp.width / dpr) + 'px';
            canvas.style.height = (vp.height / dpr) + 'px';

            await page.render({ canvasContext: canvas.getContext('2d'), viewport: vp }).promise;

            if (el._job !== job) return;          
            el.style.width  = canvas.style.width; 
            el.style.height = canvas.style.height;
            el.replaceChildren(canvas);
        } catch (e) {
            if (e && e.name !== 'RenderingCancelledException') console.error(e);
            if (el._job === job) el._job = 0;
        }
    }

    function freePage(el) {
        if (!el._job) return;
        el._job = 0;
        el.replaceChildren(); 
    }

    function goToPage(n) {
        n = Math.min(Math.max(1, n), doc.numPages);
        current = n;
        pageInput.value = n;
        scroller.scrollTop = pages[n - 1].offsetTop - 8;
    }

    
    let ticking = false;
    scroller.addEventListener('scroll', () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(() => {
            ticking = false;
            const ref = scroller.scrollTop + scroller.clientHeight / 3;
            let n = 1;
            for (let i = 0; i < pages.length; i++) {
                if (pages[i].offsetTop <= ref) n = i + 1; else break;
            }
            current = n;
            if (document.activeElement !== pageInput) pageInput.value = n;
        });
    });

    function zoomBy(factor) {
        fitMode = false;
        scale = Math.min(4, Math.max(0.4, scale * factor));
        build(current);
    }

    document.getElementById('pdfPrev').onclick    = () => goToPage(current - 1);
    document.getElementById('pdfNext').onclick    = () => goToPage(current + 1);
    document.getElementById('pdfZoomIn').onclick  = () => zoomBy(1.2);
    document.getElementById('pdfZoomOut').onclick = () => zoomBy(1 / 1.2);
    document.getElementById('pdfFit').onclick     = () => { fitMode = true; scale = fitScale(); build(current); };
    pageInput.addEventListener('change', () => goToPage(parseInt(pageInput.value, 10) || 1));
    pageInput.addEventListener('keydown', e => { if (e.key === 'Enter') pageInput.blur(); });

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (doc && fitMode && scroller.clientWidth > 0) { scale = fitScale(); build(current); }
        }, 200);
    });

    const pane = document.getElementById('kebijakan-pane');
    const tabBtn = document.getElementById('kebijakan-tab');
    if (pane && pane.classList.contains('active')) {
        init();
    } else if (tabBtn) {
        tabBtn.addEventListener('shown.bs.tab', init, { once: true });
    }
})();
</script>
@endif
@endsection