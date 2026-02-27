@extends('layouts.app')

@section('title', $pimpinan->nama . ' - Pimpinan RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tentang.index') }}">Tentang</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pimpinan.index') }}">Pimpinan</a></li>
                <li class="breadcrumb-item active">{{ $pimpinan->nama }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Hero profil --}}
                <div class="profile-hero">
                    <div class="profile-photo">
                        @if($pimpinan->foto)
                            <img src="{{ asset('storage/' . $pimpinan->foto) }}" alt="{{ $pimpinan->nama }}">
                        @else
                            <div class="profile-photo-placeholder">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                    </div>
                    <div class="profile-info">
                        {{-- <span class="card-chip mb-2">RTPU PNJ</span> --}}
                        <h1 class="profile-name">{{ $pimpinan->nama }}</h1>
                        <div class="profile-meta">
                            <span class="profile-jabatan">
                                <i class="bi bi-briefcase"></i>
                                {{ $pimpinan->jabatan }}
                            </span>
                            <span class="profile-institusi">
                                <i class="bi bi-building"></i>
                                Politeknik Negeri Jakarta
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                @if($pimpinan->deskripsi)
                <div class="profile-section">
                    <h5 class="profile-section-title">Profil</h5>
                    <div class="article-body">
                        <p style="white-space: pre-line;">{{ strip_tags($pimpinan->deskripsi) }}</p>
                    </div>
                </div>
                @endif

                {{-- Tombol aksi --}}
                {{-- <div class="d-flex gap-3 flex-wrap mt-5 pt-4" style="border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('pimpinan.index') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pimpinan
                    </a>
                    <a href="{{ route('hubungi-kami') }}" class="btn-contact">
                        <i class="bi bi-envelope"></i> Hubungi Kami
                    </a>
                </div> --}}

            </div>
        </div>

        {{-- ===== PIMPINAN LAINNYA ===== --}}
        @if($related->count())
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">Tim Kami</span>
                <h2 class="section-title mt-1">Pimpinan Lainnya</h2>
            </div>
            <div class="row g-4 justify-content">
                @foreach($related as $item)
                <div class="col-md-4 col-lg-3">
                    <div class="person-card h-100 position-relative">
                        <div class="person-photo">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                            @else
                                <div class="person-photo-placeholder">
                                    <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </div>
                        <div class="person-body">
                            <span class="person-jabatan">{{ $item->jabatan }}</span>
                            <h6 class="person-name">
                                <a href="{{ route('pimpinan.show', $item->slug) }}"
                                   >{{ $item->nama }}</a>
                            </h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('pimpinan.index') }}" class="btn-lihat-semua">
                    Lihat Semua Pimpinan <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

    </div>
</section>

<style>
/* ─── Breadcrumb ─── */
.breadcrumb-custom {
    background: none;
    padding: 0;
    margin: 0;
    font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a {
    color: #00998a;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.breadcrumb-custom .breadcrumb-item a:hover { color: #006b5e; }
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: #d1d5db;
}

/* ─── Chip ─── */
.card-chip {
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #00998a;
    background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.15);
    padding: 0.18rem 0.7rem;
    border-radius: 50px;
}

/* ─── Profile hero ─── */
.profile-hero {
    display: grid;
    grid-template-columns: 220px 1fr;
    gap: 2rem;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 2rem;
}

@media (max-width: 575.98px) {
    .profile-hero {
        grid-template-columns: 1fr;
    }
}

.profile-photo {
    height: 260px;
    overflow: hidden;
}

.profile-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    display: block;
}

.profile-photo-placeholder {
    width: 100%;
    height: 100%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #d1d5db;
    font-size: 5rem;
}

.profile-info {
    padding: 2rem 2rem 2rem 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 0.5rem;
}

@media (max-width: 575.98px) {
    .profile-info { padding: 1.5rem; }
}

.profile-name {
    font-size: 1.55rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.02em;
    line-height: 1.3;
    margin: 0.3rem 0 0.75rem;
}

.profile-meta {
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
}

.profile-jabatan,
.profile-institusi {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.88rem;
}

.profile-jabatan {
    color: #00998a;
    font-weight: 600;
}

.profile-institusi {
    color: #9ca3af;
    font-weight: 400;
}

/* ─── Profile section ─── */
.profile-section {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 1.75rem;
}

.profile-section-title {
    font-size: 1rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.01em;
    margin-bottom: 1rem;
}

/* ─── Article body ─── */
.article-body {
    font-size: 1rem;
    line-height: 1.9;
    color: #374151;
}

.article-body p { margin-bottom: 1.25rem; }
.article-body p:last-child { margin-bottom: 0; }

/* ─── Action buttons ─── */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
    text-decoration: none;
    transition: color 0.2s;
}
.btn-back:hover { color: #00998a; }

.btn-contact {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: #ffffff;
    background: #00998a;
    border: none;
    padding: 0.55rem 1.4rem;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.22s ease, transform 0.22s ease;
}
.btn-contact:hover {
    background: #006b5e;
    color: #ffffff;
    transform: translateY(-1px);
}

/* ─── Related section ─── */
.related-section {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid #e5e7eb;
}

.related-header { margin-bottom: 1.75rem; }

.section-eyebrow {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #00998a;
    background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18);
    padding: 0.22rem 0.8rem;
    border-radius: 50px;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.02em;
    line-height: 1.25;
    margin: 0;
}

/* ─── Person card (sama dengan pimpinan index) ─── */
.person-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    text-align: center;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}

.person-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.11);
    border-color: transparent;
}

.person-photo {
    width: 100%;
    height: 200px;
    overflow: hidden;
    flex-shrink: 0;
}

.person-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    display: block;
    transition: transform 0.35s ease;
}

.person-card:hover .person-photo img { transform: scale(1.04); }

.person-photo-placeholder {
    width: 100%;
    height: 100%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #d1d5db;
    font-size: 4rem;
}

.person-body {
    padding: 1.2rem 1.1rem 1.4rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
}

.person-jabatan {
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #00998a;
    background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.15);
    padding: 0.18rem 0.7rem;
    border-radius: 50px;
    margin-bottom: 0.55rem;
}

.person-name {
    font-size: 0.925rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
    margin: 0;
}

.person-name a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}
.person-name a:hover { color: #00998a; }

/* ─── Lihat semua ─── */
.btn-lihat-semua {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35);
    background: transparent;
    padding: 0.55rem 1.4rem;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.btn-lihat-semua:hover {
    background: #e6f7f5;
    color: #006b5e;
    border-color: #00998a;
}
</style>

@endsection