<footer class="footer-main">
    <div class="container">

        <div class="footer-grid">

            {{-- Kolom 1: Logo & Deskripsi --}}
            <div class="footer-col footer-col--brand">
                <div class="footer-brand">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo PNJ" height="46">
                    <div class="footer-brand-text">
                        <span class="footer-brand-name">RTPU PNJ</span>
                        <span class="footer-brand-sub">Politeknik Negeri Jakarta</span>
                    </div>
                </div>
                <p class="footer-desc">
                    Rekayasa Teknologi dan Pusat Unggulan (RTPU) Politeknik Negeri Jakarta adalah
                    pusat riset dan inovasi teknologi terapan untuk mendukung industri dan masyarakat Indonesia.
                </p>
                {{-- Social Media --}}
                <div class="footer-socials">
                    <a href="https://www.facebook.com/PoliteknikNegeriJakartaOfficial/" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/politekniknegerijakarta" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/@PNJTVOfficial" target="_blank" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="https://x.com/HumasPNJ" target="_blank" aria-label="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div class="footer-col">
                <h6 class="footer-col-title">Tautan Cepat</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('artikel-inovasi.index') }}">Artikel Inovasi</a></li>
                    <li><a href="{{ route('tentang.index') }}">Tentang RTPU</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
                    <li><a href="{{ route('sertifikasi.index') }}">Pelatihan</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Pusat Unggulan --}}
            <div class="footer-col">
                <h6 class="footer-col-title">Pusat Unggulan</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('produk-unggulan.index') }}">Produk Unggulan</a></li>
                    <li><a href="{{ route('produk-inovasi.index') }}">Produk Inovasi</a></li>
                    <li><a href="{{ route('aksen.index') }}">AkSEN</a></li>
                    <li><a href="{{ route('caint.index') }}">CAINT</a></li>
                    <li><a href="{{ route('care.index') }}">CARE</a></li>
                    <li><a href="{{ route('pudewi.index') }}">PUDEWI</a></li>
                    <li><a href="{{ route('putoi.index') }}">PUTOI</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div class="footer-col">
                <h6 class="footer-col-title">Kontak Kami</h6>
                <ul class="footer-contact">
                    <li>
                        <span class="contact-icon"><i class="bi bi-geo-alt-fill"></i></span>
                        <span>Jl. Prof. Dr. G.A. Siwabessy, Kampus UI Depok, Jawa Barat 16425</span>
                    </li>
                    <li>
                        <span class="contact-icon"><i class="bi bi-telephone-fill"></i></span>
                        <span>021-7270036 ext 217</span>
                    </li>
                    <li>
                        <span class="contact-icon"><i class="bi bi-envelope-fill"></i></span>
                        <a href="mailto:upartpu@pnj.ac.id">upartpu@pnj.ac.id</a>
                    </li>
                    <li>
                        <span class="contact-icon"><i class="bi bi-globe"></i></span>
                        <a href="https://www.pnj.ac.id" target="_blank" rel="noopener">www.pnj.ac.id</a>
                    </li>
                </ul>
            </div>

        </div>

    </div>

    {{-- Bottom bar --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p>&copy; {{ date('Y') }} RTPU Politeknik Negeri Jakarta. All rights reserved.</p>
                <p>Rekayasa Teknologi dan Produk Unggulan Politeknik Negeri Jakarta</p>
            </div>
        </div>
    </div>
</footer>

<style>
/* ─── Footer ─── */
.footer-main {
    background: #0d0d0d;
    padding: 4rem 0 0;
    font-family: "Poppins", sans-serif;
}

/* Grid layout */
.footer-grid {
    display: grid;
    grid-template-columns: 1.8fr 1fr 1fr 1.4fr;
    gap: 3rem;
    padding-bottom: 3rem;
}

@media (max-width: 991.98px) {
    .footer-grid {
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem 2rem;
    }
}

@media (max-width: 575.98px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

/* Brand column */
.footer-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

/* Logo — tanpa filter invert, warna asli logo tetap terjaga */
.footer-brand img {
    height: 46px;
    width: auto;
    display: block;
    flex-shrink: 0;
}

.footer-brand-text {
    display: flex;
    flex-direction: column;
}

.footer-brand-name {
    font-size: 0.95rem;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.2;
    letter-spacing: 0.01em;
}

.footer-brand-sub {
    font-size: 0.68rem;
    font-weight: 400;
    color: rgba(255,255,255,0.4);
    line-height: 1.4;
}

.footer-desc {
    font-size: 0.845rem;
    color: rgba(255,255,255,0.38);
    line-height: 1.8;
    margin: 0 0 1.5rem;
    max-width: 280px;
    text-align: justify;
}

/* Social icons */
.footer-socials {
    display: flex;
    gap: 0.5rem;
}

.footer-socials a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
    color: rgba(255,255,255,0.5);
    font-size: 0.9rem;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.08);
    transition: background 0.22s ease, color 0.22s ease, border-color 0.22s ease;
}

.footer-socials a:hover {
    background: #00998a;
    color: #ffffff;
    border-color: #00998a;
}

/* Column title */
.footer-col-title {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.8);
    margin-bottom: 1.1rem;
}

/* Nav links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0;
}

.footer-links a {
    display: inline-block;
    font-size: 0.875rem;
    font-weight: 400;
    color: rgba(255,255,255,0.42);
    text-decoration: none;
    padding: 0.28rem 0;
    transition: color 0.2s ease, padding-left 0.2s ease;
}

.footer-links a:hover {
    color: #ffffff;
    padding-left: 4px;
}

/* Contact list */
.footer-contact {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
}

.footer-contact li {
    display: flex;
    align-items: flex-start;
    gap: 0.65rem;
    font-size: 0.855rem;
    color: rgba(255,255,255,0.42);
    line-height: 1.55;
}

.contact-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 7px;
    background: rgba(0,153,138,0.15);
    color: #00c2ae;
    font-size: 0.8rem;
    flex-shrink: 0;
    margin-top: 1px;
}

.footer-contact a {
    color: rgba(255,255,255,0.42);
    text-decoration: none;
    transition: color 0.2s ease;
}

.footer-contact a:hover {
    color: #ffffff;
}

/* Bottom bar */
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.07);
    background: #0d0d0d;
}

.footer-bottom-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.35rem;
    padding: 1.1rem 0;
}

.footer-bottom-inner p {
    font-size: 0.775rem;
    color: rgba(255,255,255,0.22);
    margin: 0;
}
</style>