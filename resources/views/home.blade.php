@extends('layouts.app')

@section('title', 'Home - RTPU PNJ')

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="hero-section" style="position:relative; min-height:82vh; overflow:hidden; padding:0;">
    {{-- Background Image --}}
    <div style="position:absolute; inset:0; z-index:0;">
        <img src="{{ asset('logo/foto-pnj.jpg') }}" alt="RTPU PNJ"
             style="width:100%; height:100%; object-fit:cover; display:block;">

        <div style="position:absolute; inset:0; background: linear-gradient(to right, rgba(0,60,50,0.85) 50%, rgba(0,60,50,0.3) 100%);"></div>
    </div>

    <div class="container hero-content" style="position:relative; z-index:1;">
        <div class="row align-items-center" style="min-height:82vh;">
            <div class="col-lg-6 col-md-8">
                <div class="hero-eyebrow">Rekayasa Teknologi & Pusat Unggulan</div>
                <h1>
                    RTPU Politeknik<br>
                    <span class="highlight">Negeri Jakarta</span>
                </h1>
                <p class="lead">
                    Rekayasa Teknologi dan Produk Unggulan (RTPU) Politeknik Negeri Jakarta berfokus pada penelitian terapan, pengembangan produk, dan transfer teknologi untuk mendukung industri serta peningkatan kompetensi mahasiswa dan staf. Kami bekerja sama dengan mitra industri untuk mengkomersialkan inovasi dan menyediakan pelatihan yang relevan dengan kebutuhan pasar.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('tentang.index') }}" class="btn-hero-primary">
                        <i class="bi bi-info-circle"></i> Tentang Kami
                    </a>
                    {{-- <a href="{{ route('produk-unggulan.index') }}" class="btn-hero-secondary">
                        <i class="bi bi-grid"></i> Produk Kami
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== STATISTIK ===================== --}}
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">{{ $stats['artikel_inovasi'] }}</div>
                <div class="stat-label">Artikel Inovasi</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $stats['produk_unggulan'] }}</div>
                <div class="stat-label">Produk Unggulan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $stats['produk_inovasi'] }}</div>
                <div class="stat-label">Produk Inovasi</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $stats['sertifikasi'] }}</div>
                <div class="stat-label">Sertifikasi</div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== VIDEO PROFIL ===================== --}}
<section class="home-section">
    <div class="container">
        <div class="section-head text-center">
            <span class="section-eyebrow">Profil</span>
            <h2 class="section-title">Video Profil RTPU PNJ</h2>
            <p class="section-subtitle mx-auto">Kenali lebih dekat Rekayasa Teknologi dan Pusat Unggulan Politeknik Negeri Jakarta</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="ratio ratio-16x9 rounded-4 overflow-hidden" style="box-shadow: 0 12px 40px rgba(0,0,0,0.12);">
                    <iframe
                        src="https://www.youtube.com/embed/Im00a5ZL46I?si=yLLF5wFikHgNixod"
                        title="Video Profil RTPU PNJ"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== ARTIKEL INOVASI ===================== --}}
<section class="home-section">
    <div class="container">
        <div class="section-head-row">
            <div>
                {{-- <span class="section-eyebrow">Terbaru</span> --}}
                <h2 class="section-title">Artikel Inovasi</h2>
            </div>
            <a href="{{ route('artikel-inovasi.index') }}" class="btn-lihat-semua">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($artikelInovasi as $artikel)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('artikel-inovasi.show', $artikel->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">Artikel Inovasi</span>
                        @if($artikel->thumbnail)
                            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}">
                        @else
                            <div class="content-card-thumb-placeholder"><i class="bi bi-file-text"></i></div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $artikel->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $artikel->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($artikel->judul, 65) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($artikel->isi)), 110) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-newspaper"></i>
                    <p>Belum ada artikel inovasi.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================== BERITA ===================== --}}
<section class="home-section">
    <div class="container">
        <div class="section-head-row">
            <div>
                {{-- <span class="section-eyebrow">Informasi</span> --}}
                <h2 class="section-title">Berita Terkini</h2>
            </div>
            <a href="{{ route('berita.index') }}" class="btn-lihat-semua">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($beritartpu as $berita)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('berita.show', $berita->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">Berita</span>
                        @if($berita->thumbnail)
                            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}">
                        @else
                            <div class="content-card-thumb-placeholder"><i class="bi bi-newspaper"></i></div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $berita->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $berita->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($berita->judul, 65) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($berita->isi)), 110) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12"><div class="empty-state"><i class="bi bi-megaphone"></i><p>Belum ada berita.</p></div></div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================== PENGUMUMAN ===================== --}}
<section class="home-section">
    <div class="container">
        <div class="section-head-row">
            <div>
                {{-- <span class="section-eyebrow">Penting</span> --}}
                <h2 class="section-title">Pengumuman</h2>
            </div>
            <a href="{{ route('pengumuman.index') }}" class="btn-lihat-semua">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($pengumumanrtpu as $pengumuman)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">Pengumuman</span>
                        @if($pengumuman->thumbnail)
                            <img src="{{ asset('storage/' . $pengumuman->thumbnail) }}" alt="{{ $pengumuman->judul }}">
                        @else
                            <div class="content-card-thumb-placeholder"><i class="bi bi-megaphone"></i></div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $pengumuman->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $pengumuman->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($pengumuman->judul, 65) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($pengumuman->isi)), 110) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12"><div class="empty-state"><i class="bi bi-bell"></i><p>Belum ada pengumuman.</p></div></div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================== PRODUK UNGGULAN ===================== --}}
<section class="home-section">
    <div class="container">
        <div class="section-head-row">
            <div>
                {{-- <span class="section-eyebrow">Unggulan</span> --}}
                <h2 class="section-title">Produk Unggulan</h2>
            </div>
            <a href="{{ route('produk-unggulan.index') }}" class="btn-lihat-semua">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($produkUnggulan as $produk)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('produk-unggulan.show', $produk->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">Produk Unggulan</span>
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}">
                        @else
                            <div class="content-card-thumb-placeholder"><i class="bi bi-star"></i></div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $produk->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $produk->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($produk->nama, 50) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($produk->deskripsi)), 80) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12"><div class="empty-state"><i class="bi bi-star"></i><p>Belum ada produk unggulan.</p></div></div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================== PRODUK INOVASI ===================== --}}
<section class="home-section">
    <div class="container">
        <div class="section-head-row">
            <div>
                {{-- <span class="section-eyebrow">Inovasi</span> --}}
                <h2 class="section-title">Produk Inovasi</h2>
            </div>
            <a href="{{ route('produk-inovasi.index') }}" class="btn-lihat-semua">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($produkInovasi as $produk)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('produk-inovasi.show', $produk->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">Produk Inovasi</span>
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}">
                        @else
                            <div class="content-card-thumb-placeholder"><i class="bi bi-lightbulb"></i></div>
                        @endif
                    </div>
                    <div class="content-card-body">  
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $produk->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $produk->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($produk->nama, 50) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($produk->deskripsi)), 80) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12"><div class="empty-state"><i class="bi bi-lightbulb"></i><p>Belum ada produk inovasi.</p></div></div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================== SERTIFIKASI ===================== --}}
<section class="home-section">
    <div class="container">
        <div class="section-head-row">
            <div>
                {{-- <span class="section-eyebrow">Pelatihan</span> --}}
                <h2 class="section-title">Sertifikasi</h2>
            </div>
            <a href="{{ route('sertifikasi.index') }}" class="btn-lihat-semua">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($sertifikasirtpu as $sertifikasi)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('sertifikasi.show', $sertifikasi->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                    <div class="content-card-thumb">
                        <span class="card-chip">{{ Str::limit($sertifikasi->penyelenggara, 30) }}</span>
                        @if($sertifikasi->gambar)
                            <img src="{{ asset('storage/' . $sertifikasi->gambar) }}" alt="{{ $sertifikasi->nama }}">
                        @else
                            <div class="content-card-thumb-placeholder"><i class="bi bi-patch-check"></i></div>
                        @endif
                    </div>
                    <div class="content-card-body">
                        <div class="date-badge mt-1 mb-2">
                            <i class="bi bi-calendar3"></i>
                            {{ $sertifikasi->created_at->translatedFormat('d F Y') }}
                            <span class="date-sep">·</span>
                            <i class="bi bi-clock"></i>
                            {{ $sertifikasi->created_at->format('H:i') }} WIB
                        </div>
                        <h6 class="content-card-title">
                            {{ Str::limit($sertifikasi->nama, 55) }}
                        </h6>
                        <p class="content-card-excerpt">{{ Str::limit(html_entity_decode(strip_tags($sertifikasi->deskripsi)), 80) }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12"><div class="empty-state"><i class="bi bi-award"></i><p>Belum ada sertifikasi.</p></div></div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <div class="cta-content">
                <h2 class="cta-title">Ada Pertanyaan atau Kerja Sama?</h2>
                <p class="cta-desc">Kami siap membantu Anda. Hubungi tim RTPU PNJ untuk informasi lebih lanjut tentang produk, inovasi, dan peluang kerja sama.</p>
            </div>
            <a href="{{ route('hubungi-kami') }}" class="btn-cta-primary">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

{{-- ===================== STYLES ===================== --}}
<style>
.home-section { padding: 5rem 0; background: #ffffff; }
.home-section.bg-gray { background: #f9fafb; }

.section-head { margin-bottom: 2.5rem; }

.section-head-row {
    display: flex; justify-content: space-between;
    align-items: flex-end; margin-bottom: 2rem; gap: 1rem;
}

.section-eyebrow {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem;
    border-radius: 50px; margin-bottom: 0.5rem;
}

.section-title {
    font-size: 1.65rem; font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.25; margin: 0;
}

.section-subtitle { font-size: 0.95rem; color: #6b7280; max-width: auto; margin-top: 0.5rem; }

.btn-lihat-semua {
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-size: 0.82rem; font-weight: 600; color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35); background: transparent;
    padding: 0.42rem 1.1rem; border-radius: 50px; text-decoration: none; white-space: nowrap;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.btn-lihat-semua:hover { background: #e6f7f5; color: #006b5e; border-color: #00998a; }

/* ─── Content Card ─── */
.content-card {
    background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px;
    overflow: hidden; display: flex; flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.content-card:hover {
    transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,0.11); border-color: transparent;
}
.content-card-thumb { width: 100%; height: 190px; overflow: hidden; flex-shrink: 0; position: relative; }
.content-card-thumb img {
    width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.35s ease;
}

.content-card-thumb-placeholder {
    width: 100%; height: 100%; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2.5rem;
}
.content-card-body {
    padding: 1.25rem 1.35rem 1.5rem; display: flex; flex-direction: column; flex: 1;
}
.card-chip {
    position: absolute;
    top: 0.6rem;
    right: 0.6rem;
    z-index: 1;
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #00998a;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(4px);
    border: 1px solid rgba(0,153,138,0.2);
    padding: 0.16rem 0.6rem;
    border-radius: 50px;
    max-width: calc(100% - 1.2rem);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.date-badge {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.73rem; font-weight: 500; color: #9ca3af;
}
.date-sep {
    opacity: 0.5;
    margin: 0 0.1rem;
}
.content-card-title {
    font-size: 0.925rem; font-weight: 600; color: #111827;
    line-height: 1.45; letter-spacing: -0.01em; margin: 0 0 0.5rem; text-align: justify;
}
.content-card-title a { color: inherit; text-decoration: none; }
.content-card-title a:hover { color: #00998a; }
.content-card-excerpt { font-size: 0.845rem; color: #6b7280; line-height: 1.65; margin: 0; flex: 1; text-align: justify;}

/* ─── Stats bar ─── */
.stats-bar { background: #00998a; padding: 2.25rem 0; }
.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; text-align: center; }
.stat-number { font-size: 2.1rem; font-weight: 800; color: #ffffff; line-height: 1; letter-spacing: -0.03em; }
.stat-label { font-size: 0.8rem; font-weight: 400; color: rgba(255,255,255,0.72); margin-top: 0.35rem; }
@media (max-width: 575.98px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }

/* ─── CTA ─── */
.cta-section { padding: 5rem 0; background: #ffffff; }
.cta-box {
    background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 20px; padding: 3rem;
    display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap;
}
.cta-title { font-size: 1.45rem; font-weight: 700; color: #111827; letter-spacing: -0.02em; margin-bottom: 0.5rem; }
.cta-desc { font-size: 0.9rem; color: #6b7280; max-width: auto; line-height: 1.7; margin: 0; }
.btn-cta-primary {
    display: inline-flex; align-items: center; gap: 0.5rem;
    font-family: "Poppins", sans-serif; font-size: 0.9rem; font-weight: 600;
    color: #ffffff; background: #00998a; border: none;
    padding: 0.85rem 2rem; border-radius: 50px; text-decoration: none; white-space: nowrap;
    transition: background 0.22s ease, transform 0.22s ease, box-shadow 0.22s ease; flex-shrink: 0;
}
.btn-cta-primary:hover {
    background: #006b5e; color: #ffffff;
    transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,153,138,0.3);
}

/* ─── Empty state ─── */
.empty-state { text-align: center; padding: 3rem; color: #9ca3af; }
.empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.75rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }
</style>

@endsection