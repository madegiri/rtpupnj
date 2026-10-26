@php $trackId = 'kegiatanTrack-' . $jenis; @endphp

@if(!empty($items))
<div class="slider-wrap">
    <button class="slider-nav slider-nav-prev" type="button" onclick="slideGallery('{{ $trackId }}', -1)">
        <i class="bi bi-chevron-left"></i>
    </button>

    <div class="slider-track slider-track-kegiatan" id="{{ $trackId }}">
        @foreach(\App\Models\UnitPUT::urutTerbaru($items) as $item)
        @if(!empty($item['slug']))
        <div class="kegiatan-slide">
            <a href="{{ route('put.kegiatan', [$unitPut->slug, $jenis, $item['slug']]) }}"
               class="content-card" style="text-decoration:none; color:inherit;">
                <div class="content-card-thumb">
                    @if(!empty($item['foto']))
                        <img src="{{ asset('storage/' . $item['foto']) }}" alt="{{ $item['judul'] ?? '' }}" loading="lazy">
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
                    <h6 class="content-card-title">
                        {{ Str::limit(\App\Services\TranslateService::to($item['judul'] ?? '', app()->getLocale()), 80) }}
                    </h6>
                    <p class="content-card-excerpt">
                        {{ Str::limit(\App\Services\TranslateService::to(html_entity_decode(strip_tags($item['isi'] ?? '')), app()->getLocale()), 100) }}
                    </p>
                </div>
            </a>
        </div>
        @endif
        @endforeach
    </div>

    <button class="slider-nav slider-nav-next" type="button" onclick="slideGallery('{{ $trackId }}', 1)">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>
@else
<div class="empty-state">
    <i class="bi bi-calendar-event"></i>
    <p>{{ \App\Services\TranslateService::to($empty, app()->getLocale()) }}</p>
</div>
@endif