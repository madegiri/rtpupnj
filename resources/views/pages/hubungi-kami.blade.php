@extends('layouts.app')

@section('title', 'Hubungi Kami - RTPU PNJ')

@section('content')
<section class="py-5">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header text-center mb-5">
            <span class="section-eyebrow">Kontak</span>
            <h1 class="section-title mt-1">Hubungi Kami</h1>
            <p class="section-subtitle mx-auto">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami.</p>
        </div>

        {{-- Info Kontak --}}
        <div class="row g-4 justify-content-center mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="contact-card">
                    <div class="contact-ic">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="contact-label">Alamat</div>
                    <div class="contact-value">
                        Jl. Prof. Dr. G.A. Siwabessy,<br>
                        Kampus UI Depok, Jawa Barat 16425
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="contact-card">
                    <div class="contact-ic">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div class="contact-label">Telepon</div>
                    <div class="contact-value">
                        <a href="tel:0217863534">(021) 7863534</a><br>
                        <a href="tel:0217864108">(021) 7864108</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="contact-card">
                    <div class="contact-ic">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="contact-label">Email</div>
                    <div class="contact-value">
                        <a href="mailto:rtpu@pnj.ac.id">rtpu@pnj.ac.id</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="contact-card">
                    <div class="contact-ic">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div class="contact-label">Jam Operasional</div>
                    <div class="contact-value">
                        Senin – Jumat<br>
                        08.00 – 16.00 WIB
                    </div>
                </div>
            </div>
        </div>

        {{-- Google Maps --}}
        <div class="maps-section-header">
            <div>
                <span class="section-eyebrow">Peta</span>
                <h2 class="maps-title">Lokasi Kami</h2>
                {{-- <p class="maps-address">
                    <i class="bi bi-geo-alt-fill"></i>
                    Jl. Prof. Dr. G.A. Siwabessy, Kampus UI Depok, Jawa Barat 16425
                </p> --}}
            </div>
            <a href="https://maps.google.com/?q=Politeknik+Negeri+Jakarta,+Depok"
               target="_blank" class="btn-directions">
                <i class="bi bi-map"></i> Buka di Google Maps
            </a>
        </div>
        <div class="maps-wrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.474688931055!2d106.82350337499999!3d-6.371663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ece03eb40bbb%3A0x81ffb5ec0c7de1d4!2sPoliteknik%20Negeri%20Jakarta!5e0!3m2!1sid!2sid!4v1708000000000"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>
</section>

<style>
/* ─── Page header ─── */
.section-eyebrow {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem; border-radius: 50px;
}
.section-title {
    font-size: 1.85rem; font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 0.4rem;
}
.section-subtitle {
    font-size: 0.95rem; color: #6b7280; margin: 0; max-width: auto;
}

/* ─── Contact card ─── */
.contact-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 1.75rem 1.5rem;
    height: 100%;
    text-align: center;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}

.contact-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.09);
    border-color: transparent;
}

.contact-ic {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: #e6f7f5;
    color: #00998a;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.contact-label {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #9ca3af;
    margin-bottom: 0.5rem;
}

.contact-value {
    font-size: 0.9rem;
    color: #374151;
    line-height: 1.7;
}

.contact-value a {
    color: #374151;
    text-decoration: none;
    transition: color 0.2s;
}

.contact-value a:hover {
    color: #00998a;
}

/* ─── Maps header ─── */
.maps-section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1.25rem;
}

.maps-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    letter-spacing: -0.02em;
    margin: 0.4rem 0 0.5rem;
}

.maps-address {
    font-size: 0.88rem;
    color: #6b7280;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

.maps-address i { color: #00998a; }

.btn-directions {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35);
    background: transparent;
    padding: 0.55rem 1.25rem;
    border-radius: 50px;
    text-decoration: none;
    white-space: nowrap;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
    flex-shrink: 0;
}

.btn-directions:hover {
    background: #e6f7f5;
    color: #006b5e;
    border-color: #00998a;
}

/* ─── Maps ─── */
.maps-wrapper {
    height: 380px;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}
</style>

@endsection