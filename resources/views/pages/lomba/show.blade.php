@extends('layouts.app')

@section('title', $lomba->nama_lomba . ' - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('lomba.index') }}">Lomba</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($lomba->nama_lomba, 40) }}</li>
            </ol>
        </nav>

        <h1 class="article-title mt-2">{{ $lomba->nama_lomba }}</h1>

        <div class="article-meta">
            <span class="date-badge">
                <i class="bi bi-calendar3"></i>
                {{ $lomba->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
            </span>
            <span class="date-sep">·</span>
            <span class="date-badge">
                <i class="bi bi-clock"></i>
                {{ $lomba->created_at->format('H:i') }} WIB
            </span>
        </div>

        <div class="row g-4">

            {{-- Poster Kiri --}}
            <div class="col-lg-6">
                <div class="poster-sticky">
                    <div style="position: relative;">
                        <span class="card-chip">{{ $lomba->kategoriLomba->nama_kategori }}</span>
                        @if($lomba->gambar)
                            <img src="{{ asset('storage/' . $lomba->gambar) }}" alt="Poster {{ $lomba->nama_lomba }}" class="poster-img lightbox-trigger" onclick="openLightbox(this.src)">
                        @else
                            <div class="poster-placeholder">
                                <i class="bi bi-trophy"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Info Kanan --}}
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-row">
                        <span class="info-label"><i class="bi bi-tag"></i> Kategori Lomba</span>
                        <span class="info-value">{{ $lomba->kategoriLomba->nama_kategori }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label"><i class="bi bi-geo-alt"></i> Jenis Pelaksanaan Lomba</span>
                        <span class="info-value">{{ \App\Models\Lomba::JENIS_PELAKSANAAN[$lomba->jenis_pelaksanaan] }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label"><i class="bi bi-people"></i> Peserta Lomba</span>
                        <div class="d-flex flex-wrap gap-1 mt-1">
                            @foreach($lomba->kategori_peserta as $peserta)
                                <span class="badge-peserta">{{ \App\Models\Lomba::KATEGORI_PESERTA[$peserta] ?? $peserta }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label"><i class="bi bi-calendar3"></i> Tanggal Pendaftaran Lomba</span>
                        <span class="info-value">
                            @php
                                $mulai   = $lomba->tanggal_mulai_pendaftaran->locale('id');
                                $selesai = $lomba->tanggal_selesai_pendaftaran->locale('id');
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
                    <div class="info-row">
                        <span class="info-label"><i class="bi bi-building"></i> Penyelenggara Lomba</span>
                        <span class="info-value">{{ $lomba->penyelenggara }}</span>
                    </div>

                    @if($lomba->link_pendaftaran)
                    <a href="{{ $lomba->link_pendaftaran }}" target="_blank" rel="noopener noreferrer" class="btn-daftar mt-3">
                        <i class="bi bi-box-arrow-up-right"></i> Daftar Sekarang
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="deskripsi-box mt-4">
            <h5 class="deskripsi-title">
                <i class="bi bi-info-circle"></i> Deskripsi Lomba
            </h5>
            <div class="article-body">
                {!! $lomba->deskripsi !!}
            </div>
        </div>

        {{-- Related --}}
        <div class="related-section">
            <div class="related-header">
                <span class="section-eyebrow">Kategori {{ $lomba->kategoriLomba->nama_kategori }}</span>
                <h2 class="section-title mt-1">Lomba Lainnya</h2>
            </div>

            @if($related->count())
            <div class="row g-4">
                @foreach($related as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('lomba.show', $item->slug) }}" class="content-card h-100" style="text-decoration:none; color:inherit;">
                        <div class="content-card-thumb">
                            <span class="card-chip">{{ $item->kategoriLomba->nama_kategori }}</span>
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_lomba }}">
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
                                    {{ \App\Models\Lomba::JENIS_PELAKSANAAN[$item->jenis_pelaksanaan] }}
                                </span>
                                <span class="badge-deadline">
                                    <i class="bi bi-clock"></i>
                                    @php
                                        $mulai   = $item->tanggal_mulai_pendaftaran->locale('id');
                                        $selesai = $item->tanggal_selesai_pendaftaran->locale('id');

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
                            <h6 class="content-card-title">{{ Str::limit($item->nama_lomba, 80) }}</h6>
                            <p class="content-card-excerpt">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                            <div class="lomba-peserta mt-auto pt-2">
                                @foreach($item->kategori_peserta as $peserta)
                                    <span class="badge-peserta-rel">{{ \App\Models\Lomba::KATEGORI_PESERTA[$peserta] ?? $peserta }}</span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('lomba.index', ['kategori' => $lomba->kategori_lomba_id]) }}" class="btn-lihat-semua">
                    Lihat Semua Lomba {{ $lomba->kategoriLomba->nama_kategori }} <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @else
            <div class="empty-state">
                <i class="bi bi-trophy"></i>
                <p>Belum ada lomba lain dalam kategori ini.</p>
            </div>
            @endif
        </div>

    </div>
</section>

{{-- Lightbox --}}
<div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></button>
    <img src="" alt="" class="lightbox-img" id="lightboxImg" onclick="event.stopPropagation()">
</div>

<style>
.breadcrumb-custom {
    background: none; padding: 0; margin: 0; font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a { color: #00998a; text-decoration: none; font-weight: 500; }
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

.article-meta {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    flex-wrap: wrap;
    margin-bottom: 1.75rem;
}

.date-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.78rem;
    font-weight: 500;
    color: #9ca3af;
}

.date-sep { color: #d1d5db; font-size: 0.75rem; }

/* Poster */
.poster-sticky { position: sticky; top: 1.5rem; }
.poster-img {
    width: 100%; border-radius: 14px; display: block;
    box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    cursor: zoom-in; transition: opacity 0.2s;
    object-fit: cover;
}
.poster-img:hover { opacity: 0.92; }
.poster-placeholder {
    width: 100%; aspect-ratio: 3/4; background: #f3f4f6; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #9ca3af; font-size: 3rem;
}

/* Info Card */
.info-card {
    background: #f9fafb; border: 1px solid #e5e7eb;
    border-radius: 14px; padding: 1.5rem;
}
.info-row {
    display: flex; flex-direction: column;
    padding: 0.85rem 0; border-bottom: 1px solid #f3f4f6;
}
.info-row:last-child { border-bottom: none; padding-bottom: 0; }
.info-label {
    font-size: 0.82rem; font-weight: 600; color: #9ca3af;
    text-transform: uppercase; letter-spacing: 0.06em;
    display: flex; align-items: center; gap: 0.3rem; margin-bottom: 0.2rem;
}
.info-label i { color: #00998a; }
.info-value { font-size: 1rem; font-weight: 500; color: #111827; }

/* Article */
.chip-kategori {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem; border-radius: 50px;
}
.article-title {
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 700; color: #111827;
    line-height: 1.35; letter-spacing: -0.02em; margin-bottom: 1rem; text-align: justify;
}

/* Badges */
.lomba-badges { display: flex; flex-wrap: wrap; gap: 0.4rem; }
.badge-jenis, .badge-deadline {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.7rem; border-radius: 50px;
}
.badge-jenis { background: #e6f7f5; color: #00998a; }
.badge-deadline { background: #fef3c7; color: #92400e; }
.badge-peserta {
    font-size: 0.78rem; font-weight: 600; padding: 0.25rem 0.7rem;
    background: #f3f4f6; color: #00998a; border-radius: 50px;
}
.badge-peserta-rel {
    font-size: 0.68rem; font-weight: 600; padding: 0.18rem 0.55rem;
    background: #f3f4f6; color: #00998a; border-radius: 50px;
}

/* Deskripsi */
.deskripsi-box {
    background: #f9fafb; border: 1px solid #e5e7eb;
    border-radius: 14px; padding: 1.75rem;
}
.deskripsi-title {
    font-size: 1rem; font-weight: 700; color: #111827;
    display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;
}
.deskripsi-title i { color: #00998a; }
.article-body { font-size: 1rem; line-height: 1.9; color: #374151; text-align: justify; }
.article-body p { margin-bottom: 1.25rem; }
.article-body p:last-child { margin-bottom: 0; }
.article-body h2,.article-body h3,.article-body h4 {
    font-weight: 700; color: #111827; margin-top: 2rem; margin-bottom: 0.75rem;
}
.article-body a { color: #00998a; text-underline-offset: 3px; }
.article-body a:hover { color: #006b5e; }
.article-body ul,.article-body ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
.article-body li { margin-bottom: 0.4rem; }
.article-body blockquote {
    border-left: 3px solid #00998a; margin: 1.5rem 0;
    padding: 0.75rem 1.25rem; background: #f0fdfb;
    border-radius: 0 8px 8px 0; color: #4b5563; font-style: italic;
}

/* Buttons */
.btn-daftar {
    display: flex; align-items: center; justify-content: center; gap: 0.4rem;
    width: 100%; padding: 0.7rem 1.5rem; background: #00998a; color: #fff;
    border-radius: 10px; font-size: 0.875rem; font-weight: 600;
    text-decoration: none; transition: background 0.2s, transform 0.2s;
}
.btn-daftar:hover { background: #006b5e; color: #fff; transform: translateY(-1px); }

.btn-daftar-lg {
    display: inline-flex; align-items: center; gap: 0.45rem;
    padding: 0.7rem 2rem; background: #00998a; color: #fff;
    border-radius: 50px; font-size: 0.9rem; font-weight: 600;
    text-decoration: none; transition: background 0.2s, transform 0.2s;
}
.btn-daftar-lg:hover { background: #006b5e; color: #fff; transform: translateY(-1px); }

/* Related */
.related-section { margin-top: 4rem; padding-top: 3rem; border-top: 1px solid #e5e7eb; }
.related-header { margin-bottom: 1.75rem; }
.section-eyebrow {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem; border-radius: 50px;
}
.section-title { font-size: 1.5rem; font-weight: 700; color: #111827; letter-spacing: -0.02em; margin: 0; }

/* Content Card */
.content-card {
    background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
    overflow: hidden; display: flex; flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.content-card:hover { transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,0.11); border-color: transparent; }
.content-card-thumb { width: 100%; height: 200px; overflow: hidden; flex-shrink: 0; position: relative; }
.content-card-thumb img { width: 100%; height: 100%; object-fit: cover; object-position: top; display: block; }
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
.content-card-title { font-size: 0.925rem; font-weight: 600; color: #111827; line-height: 1.45; margin: 0 0 0.5rem; text-align: justify; }
.content-card-excerpt { font-size: 0.845rem; color: #6b7280; line-height: 1.65; margin: 0; flex: 1; text-align: justify; }
.lomba-peserta { display: flex; flex-wrap: wrap; gap: 0.3rem; border-top: 1px solid #f3f4f6; padding-top: 0.5rem; }

/* Empty state */
.empty-state { text-align: center; padding: 3rem 2rem; color: #9ca3af; }
.empty-state i { font-size: 3rem; display: block; margin-bottom: 0.85rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }

/* Lihat semua */
.btn-lihat-semua {
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-size: 0.85rem; font-weight: 600; color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35); background: transparent;
    padding: 0.55rem 1.4rem; border-radius: 50px; text-decoration: none;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.btn-lihat-semua:hover { background: #e6f7f5; color: #006b5e; border-color: #00998a; }

/* Lightbox */
.lightbox-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.88); z-index: 9999;
    align-items: center; justify-content: center;
    padding: 1.5rem; backdrop-filter: blur(6px);
}
.lightbox-overlay.active { display: flex; animation: fadeIn 0.2s ease; }
.lightbox-img {
    max-width: 90vw; max-height: 90vh; object-fit: contain;
    border-radius: 10px; box-shadow: 0 8px 40px rgba(0,0,0,0.5);
    animation: zoomIn 0.2s ease;
}
.lightbox-close {
    position: absolute; top: 1rem; right: 1.25rem;
    background: rgba(255,255,255,0.15); border: none; color: #fff;
    font-size: 1.2rem; width: 40px; height: 40px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: background 0.2s;
}
.lightbox-close:hover { background: rgba(255,255,255,0.3); }
.lightbox-trigger { cursor: zoom-in; }

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes zoomIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

@media (max-width: 991.98px) {
    .poster-sticky { position: static; }
}
</style>

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
</script>

@endsection