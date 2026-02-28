@extends('layouts.app')

@section('title', 'Pimpinan RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tentang.index') }}">Tentang</a></li>
                    <li class="breadcrumb-item active">Pimpinan RTPU PNJ</li>
                </ol>
            </nav>
            {{-- <span class="section-eyebrow">Profil</span> --}}
            <h1 class="section-title mt-1">Pimpinan RTPU PNJ</h1>
            <p class="section-subtitle">Pimpinan dan pengelola Rekayasa Teknologi dan Pusat Unggulan Politeknik Negeri Jakarta.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($pimpinans as $pimpinan)
            <div class="col-md-4 col-lg-3">
                <div class="person-card h-100 position-relative">
                    <div class="person-photo">
                        @if($pimpinan->foto)
                            <img src="{{ asset('storage/' . $pimpinan->foto) }}" alt="{{ $pimpinan->nama }}">
                        @else
                            <div class="person-photo-placeholder">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                    </div>
                    <div class="person-body">
                        <span class="person-jabatan">{{ $pimpinan->jabatan }}</span>
                        <h6 class="person-name">
                            <a href="{{ route('pimpinan.show', $pimpinan->slug) }}"
                               >{{ $pimpinan->nama }}</a>
                        </h6>
                        @if($pimpinan->deskripsi)
                        <p class="person-desc">{{ Str::limit(strip_tags($pimpinan->deskripsi), 100) }}</p>
                        
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-people"></i>
                    <p>Belum ada data pimpinan yang tersedia.</p>
                </div>
            </div>
            @endforelse
        </div>

    </div>
</section>

<style>
/* ─── Breadcrumb ─── */
.breadcrumb-custom {
    background: none;
    padding: 0;
    margin-bottom: 1.1rem;
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

/* ─── Page header ─── */
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
    font-size: 1.85rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.02em;
    line-height: 1.2;
    margin-bottom: 0.4rem;
}

.section-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin: 0;
    max-width: 520px;
}

/* ─── Person Card ─── */
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

/* Photo */
.person-photo {
    width: 100%;
    height: 240px;
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

.person-card:hover .person-photo img {
    transform: scale(1.04);
}

.person-photo-placeholder {
    width: 100%;
    height: 100%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #d1d5db;
    font-size: 4.5rem;
}

/* Body */
.person-body {
    padding: 1.35rem 1.25rem 1.5rem;
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
    margin-bottom: 0.65rem;
}

.person-name {
    font-size: 0.975rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
    letter-spacing: -0.01em;
    margin: 0 0 0.5rem;
}

.person-name a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}

.person-name a:hover { color: #00998a; }

.person-desc {
    font-size: 0.845rem;
    color: #6b7280;
    line-height: 1.65;
    margin: 0;
}

/* ─── Empty state ─── */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #9ca3af;
}
.empty-state i {
    font-size: 3rem;
    display: block;
    margin-bottom: 0.85rem;
}
.empty-state p {
    margin: 0;
    font-size: 0.9rem;
}
</style>

@endsection