@extends('layouts.app')

@section('title', 'Lomba - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Lomba</li>
                </ol>
            </nav>
            <h1 class="section-title mt-1">Lomba</h1>
            <p class="section-subtitle">Informasi lomba yang dapat diikuti.</p>
        </div>

        {{-- Search & Filter --}}
        <div class="search-filter-wrapper mb-4">
            <form action="{{ route('lomba.index') }}" method="GET">
                <div class="row g-2">

                    {{-- Search --}}
                    <div class="col-12 col-md-5">
                        <div class="search-box">
                            <i class="bi bi-search search-icon"></i>
                            <input
                                type="search"
                                name="search"
                                class="search-input"
                                placeholder="Cari lomba..."
                                value="{{ $search ?? '' }}"
                                autocomplete="off"
                            >
                            @if($search)
                                <a href="{{ route('lomba.index', array_filter(['kategori' => $kategori, 'peserta' => $peserta, 'jenis' => $jenis])) }}" class="search-clear">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="col-6 col-md-3">
                        <select name="kategori" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList as $kat)
                                <option value="{{ $kat->id }}" {{ $kategori == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Peserta --}}
                    <div class="col-6 col-md-2">
                        <select name="peserta" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Peserta</option>
                            @foreach(\App\Models\Lomba::KATEGORI_PESERTA as $key => $label)
                                <option value="{{ $key }}" {{ $peserta === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jenis Pelaksanaan --}}
                    <div class="col-12 col-md-2">
                        <select name="jenis" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis Pelaksanaan</option>
                            @foreach(\App\Models\Lomba::JENIS_PELAKSANAAN as $key => $label)
                                <option value="{{ $key }}" {{ $jenis === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Submit mobile --}}
                    {{-- <div class="col-6 col-md-12 d-md-none">
                        <button type="submit" class="btn-search w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div> --}}

                </div>

                {{-- Active filters info --}}
                @if($search || $kategori || $peserta || $jenis)
                <div class="active-filters mt-2">
                    <span class="filter-info-text">Filter aktif:</span>
                    @if($search)
                        <span class="filter-tag">
                            "{{ $search }}"
                            <a href="{{ route('lomba.index', array_filter(['kategori' => $kategori, 'peserta' => $peserta, 'jenis' => $jenis])) }}">
                                <i class="bi bi-x"></i>
                            </a>
                        </span>
                    @endif
                    @if($kategori)
                        <span class="filter-tag">
                            {{ $kategoriList->find($kategori)?->nama_kategori }}
                            <a href="{{ route('lomba.index', array_filter(['search' => $search, 'peserta' => $peserta, 'jenis' => $jenis])) }}">
                                <i class="bi bi-x"></i>
                            </a>
                        </span>
                    @endif
                    @if($peserta)
                        <span class="filter-tag">
                            {{ \App\Models\Lomba::KATEGORI_PESERTA[$peserta] }}
                            <a href="{{ route('lomba.index', array_filter(['search' => $search, 'kategori' => $kategori, 'jenis' => $jenis])) }}">
                                <i class="bi bi-x"></i>
                            </a>
                        </span>
                    @endif
                    @if($jenis)
                        <span class="filter-tag">
                            {{ \App\Models\Lomba::JENIS_PELAKSANAAN[$jenis] }}
                            <a href="{{ route('lomba.index', array_filter(['search' => $search, 'kategori' => $kategori, 'peserta' => $peserta])) }}">
                                <i class="bi bi-x"></i>
                            </a>
                        </span>
                    @endif
                    <a href="{{ route('lomba.index') }}" class="filter-reset">Reset semua</a>
                </div>
                @endif

            </form>
        </div>

        {{-- Cards --}}
        <div class="row g-4">
            @forelse($lombas as $lomba)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('lomba.show', $lomba->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">{{ $lomba->kategoriLomba->nama_kategori }}</span>
                        @if($lomba->gambar)
                            <img src="{{ asset('storage/' . $lomba->gambar) }}" alt="{{ $lomba->nama_lomba }}">
                        @else
                            <div class="content-card-thumb-placeholder">
                                <i class="bi bi-trophy"></i>
                            </div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="lomba-badges mb-2">
                            <span class="badge-jenis">
                                <i class="bi bi-geo-alt"></i>
                                {{ \App\Models\Lomba::JENIS_PELAKSANAAN[$lomba->jenis_pelaksanaan] }}
                            </span>
                            <span class="badge-deadline">
                                <i class="bi bi-clock"></i>
                                @php
                                    $mulai   = $lomba->tanggal_mulai_pendaftaran;
                                    $selesai = $lomba->tanggal_selesai_pendaftaran;

                                    $mulai->locale('id');
                                    $selesai->locale('id');

                                    $bulanSama = $mulai->month === $selesai->month;
                                    $tahunSama = $mulai->year  === $selesai->year;
                                @endphp

                                @if($bulanSama && $tahunSama)
                                    {{ $mulai->isoFormat('D') }} - {{ $selesai->isoFormat('D MMMM YYYY') }}
                                @elseif(!$bulanSama && $tahunSama)
                                    {{ $mulai->isoFormat('D MMMM') }} - {{ $selesai->isoFormat('D MMMM YYYY') }}
                                @else
                                    {{ $mulai->isoFormat('D MMMM YYYY') }} - {{ $selesai->isoFormat('D MMMM YYYY') }}
                                @endif
                            </span>
                        </div>
                        <h6 class="content-card-title">{{ Str::limit($lomba->nama_lomba, 80) }}</h6>
                        <p class="content-card-excerpt">{{ Str::limit(strip_tags($lomba->deskripsi), 100) }}</p>
                        <div class="lomba-peserta mt-auto pt-2">
                            @foreach($lomba->kategori_peserta as $peserta)
                                <span class="badge-peserta">{{ \App\Models\Lomba::KATEGORI_PESERTA[$peserta] ?? $peserta }}</span>
                            @endforeach
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-trophy"></i>
                    <p>Belum ada lomba yang tersedia.</p>
                </div>
            </div>
            @endforelse
        </div>

        @if($lombas->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <div class="pagination-wrapper">
                {{ $lombas->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</section>

<style>
.breadcrumb-custom {
    background: none; padding: 0; margin-bottom: 1.1rem; font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a {
    color: #00998a; text-decoration: none; font-weight: 500;
}
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

.section-title { font-size: 1.85rem; font-weight: 700; color: #111827; letter-spacing: -0.02em; margin-bottom: 0.4rem; }
.section-subtitle { font-size: 0.95rem; color: #6b7280; margin: 0; }

/* Search & Filter */
.search-box { position: relative; display: flex; align-items: center; }
.search-icon { position: absolute; left: 1rem; color: #9ca3af; font-size: 0.9rem; pointer-events: none; }
.search-input {
    width: 100%; padding: 0.65rem 2.8rem 0.65rem 2.6rem;
    border: 1px solid #e5e7eb; border-radius: 10px; font-size: 0.875rem;
    font-family: "Poppins", sans-serif; color: #111827; background: #fff;
    outline: none; transition: border-color 0.2s, box-shadow 0.2s;
}
.search-input:focus { border-color: #00998a; box-shadow: 0 0 0 3px rgba(0,153,138,0.1); }
.search-clear { position: absolute; right: 0.85rem; color: #9ca3af; font-size: 0.75rem; text-decoration: none; }
.search-clear:hover { color: #ef4444; }

.filter-select {
    width: 100%; padding: 0.65rem 1rem; border: 1px solid #e5e7eb;
    border-radius: 10px; font-size: 0.875rem; font-family: "Poppins", sans-serif;
    color: #111827; background: #fff; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s; cursor: pointer;
}
.filter-select:focus { border-color: #00998a; box-shadow: 0 0 0 3px rgba(0,153,138,0.1); }

.btn-search {
    width: 100%; height: 100%; padding: 0.65rem;
    background: #00998a; color: #fff; border: none;
    border-radius: 10px; font-size: 0.95rem; cursor: pointer;
    transition: background 0.2s;
}
.btn-search:hover { background: #006b5e; }

.search-result-info { font-size: 0.82rem; color: #6b7280; margin-top: 0.6rem; margin-bottom: 0; }

.active-filters {
    display: flex; flex-wrap: wrap; align-items: center; gap: 0.4rem;
}
.filter-info-text {
    font-size: 0.78rem; color: #9ca3af; font-weight: 500;
}
.filter-tag {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.75rem; font-weight: 600; color: #00998a;
    background: #e6f7f5; border: 1px solid rgba(0,153,138,0.2);
    padding: 0.18rem 0.6rem; border-radius: 50px;
}
.filter-tag a {
    color: #00998a; text-decoration: none; line-height: 1;
    display: flex; align-items: center;
}
.filter-tag a:hover { color: #ef4444; }
.filter-reset {
    font-size: 0.75rem; color: #9ca3af; text-decoration: none;
    font-weight: 500; margin-left: 0.2rem;
}
.filter-reset:hover { color: #ef4444; }

.search-input::-webkit-search-cancel-button {
    display: none;
}

/* Card */
.content-card {
    background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
    overflow: hidden; display: flex; flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.content-card:hover { transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,0.11); border-color: transparent; }
.content-card-thumb { width: 100%; height: 200px; overflow: hidden; flex-shrink: 0; position: relative; }
.content-card-thumb img { width: 100%; height: 100%; object-fit: cover; object-position: top; display: block; transition: transform 0.35s ease; }
.content-card-thumb-placeholder {
    width: 100%; height: 100%; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2.5rem;
}
.content-card-body { padding: 1.25rem 1.35rem 1.5rem; display: flex; flex-direction: column; flex: 1; }
.card-chip {
    position: absolute; top: 0.6rem; right: 0.6rem; z-index: 1;
    font-size: 0.68rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase;
    color: #00998a; background: rgba(255,255,255,0.92); backdrop-filter: blur(4px);
    border: 1px solid rgba(0,153,138,0.2); padding: 0.16rem 0.6rem; border-radius: 50px;
    max-width: calc(100% - 1.2rem); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}

/* Badges */
.lomba-badges { display: flex; flex-wrap: wrap; gap: 0.4rem; }
.badge-jenis, .badge-deadline {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.7rem; font-weight: 600; padding: 0.2rem 0.6rem;
    border-radius: 50px;
}
.badge-jenis { background: #e6f7f5; color: #00998a; }
.badge-deadline { background: #fef3c7; color: #92400e; }

.lomba-peserta { display: flex; flex-wrap: wrap; gap: 0.3rem; border-top: 1px solid #f3f4f6; }
.badge-peserta {
    font-size: 0.68rem; font-weight: 600; padding: 0.18rem 0.55rem;
    background: #f3f4f6; color: #00998a; border-radius: 50px;
}

.content-card-title { font-size: 0.925rem; font-weight: 600; color: #111827; line-height: 1.45; margin: 0 0 0.5rem; text-align: justify; }
.content-card-excerpt { font-size: 0.845rem; color: #6b7280; line-height: 1.65; margin: 0; flex: 1; text-align: justify; }

/* Empty state */
.empty-state { text-align: center; padding: 4rem 2rem; color: #9ca3af; }
.empty-state i { font-size: 3rem; display: block; margin-bottom: 0.85rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }

/* Pagination */
.pagination-wrapper .pagination { gap: 0.3rem; margin: 0; }
.pagination-wrapper .page-link {
    font-family: "Poppins", sans-serif; font-size: 0.85rem; font-weight: 500;
    color: #374151; background: #fff; border: 1px solid #e5e7eb;
    border-radius: 8px !important; padding: 0.45rem 0.85rem;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.pagination-wrapper .page-link:hover { background: #e6f7f5; color: #00998a; border-color: rgba(0,153,138,0.3); }
.pagination-wrapper .page-item.active .page-link { background: #00998a; border-color: #00998a; color: #fff; font-weight: 600; }
.pagination-wrapper .page-item.disabled .page-link { background: #f9fafb; color: #d1d5db; border-color: #e5e7eb; }
.pagination-wrapper p { display: none !important; }
</style>

@endsection