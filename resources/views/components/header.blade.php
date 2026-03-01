<nav class="navbar navbar-expand-xl sticky-top" id="mainNavbar">
    <div class="container">

        {{-- Brand / Logo --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('storage/logo-rtpu/logo.png') }}" alt="Logo PNJ" height="42">
            <div class="d-none d-md-block navbar-brand-text">
                <div class="brand-name">RTPU</div>
                <div class="brand-sub">Politeknik Negeri Jakarta</div>
            </div>
        </a>

        {{-- Toggler Mobile --}}
        <button class="navbar-toggler-custom" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">

                {{-- Beranda --}}
                <li class="nav-item dropdown">
                    <a class="nav-link-custom dropdown-toggle {{ request()->routeIs('artikel-inovasi.*', 'berita.*', 'pengumuman.*') ? 'active' : '' }}"
                       href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Beranda
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item-custom {{ request()->routeIs('artikel-inovasi.*') ? 'active' : '' }}" href="{{ route('artikel-inovasi.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                                </svg>
                            </span> Artikel Inovasi
                        </a></li>
                        <li><a class="dropdown-item-custom {{ request()->routeIs('berita.*') ? 'active' : '' }}" href="{{ route('berita.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                                </svg>
                            </span> Berita
                        </a></li>
                        <li><a class="dropdown-item-custom {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}" href="{{ route('pengumuman.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                                </svg>
                            </span> Pengumuman
                        </a></li>
                    </ul>
                </li>

                {{-- Tentang --}}
                <li class="nav-item dropdown">
                    <a class="nav-link-custom dropdown-toggle {{ request()->routeIs('tentang.*', 'pimpinan.*', 'struktur-organisasi.*') ? 'active' : '' }}" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item-custom {{ request()->routeIs('tentang.*') ? 'active' : '' }}" href="{{ route('tentang.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                            </span> Tentang RTPU PNJ
                        </a></li>
                        {{-- <li><a class="dropdown-item-custom {{ request()->routeIs('pimpinan.*') ? 'active' : '' }}" href="{{ route('pimpinan.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </span> Pimpinan RTPU PNJ
                        </a></li> --}}
                        <li><a class="dropdown-item-custom {{ request()->routeIs('struktur-organisasi.*') ? 'active' : '' }}" href="{{ route('struktur-organisasi.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </span> Struktur Organisasi
                        </a></li>
                    </ul>
                </li>

                {{-- Produk --}}
                <li class="nav-item dropdown">
                    <a class="nav-link-custom dropdown-toggle {{ request()->routeIs('produk-unggulan.*', 'produk-inovasi.*') ? 'active' : '' }}" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Produk
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item-custom {{ request()->routeIs('produk-unggulan.*') ? 'active' : '' }}" href="{{ route('produk-unggulan.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                            </span> Produk Unggulan
                        </a></li>
                        <li><a class="dropdown-item-custom {{ request()->routeIs('produk-inovasi.*') ? 'active' : '' }}" href="{{ route('produk-inovasi.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                            </span> Produk Inovasi
                        </a></li>
                    </ul>
                </li>

                {{-- Pusat Unggulan Teknologi --}}
                <li class="nav-item dropdown">
                    <a class="nav-link-custom dropdown-toggle {{ request()->routeIs('caint.*', 'aksen.*', 'pudewi.*', 'care.*', 'putoi.*') ? 'active' : '' }}" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Pusat Unggulan Teknologi
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item-custom {{ request()->routeIs('aksen.*') ? 'active' : '' }}" href="{{ route('aksen.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                            </span> AkSEN (Accounting, Sustainability, Entrepreneurship, and Halal Center)
                        </a></li>
                        <li><a class="dropdown-item-custom {{ request()->routeIs('caint.*') ? 'active' : '' }}" href="{{ route('caint.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                            </span> Center for Artificial Internet of Things (CAINT)
                        </a></li>
                        <li><a class="dropdown-item-custom {{ request()->routeIs('care.*') ? 'active' : '' }}" href="{{ route('care.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                            </span> Center for Conversion, Conservation and Applied Renewable Energies (CARE)
                        </a></li>
                        <li><a class="dropdown-item-custom {{ request()->routeIs('pudewi.*') ? 'active' : '' }}" href="{{ route('pudewi.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                            </span> Pusat Unggulan Desa Wisata Indonesia (PUDEWI)
                        </a></li>
                        <li><a class="dropdown-item-custom {{ request()->routeIs('putoi.*') ? 'active' : '' }}" href="{{ route('putoi.index') }}">
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                            </span> Pusat Unggulan Teknologi Otomasi Industri (PUTOI)
                        </a></li>
                    </ul>
                </li>

                {{-- Sertifikasi --}}
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('sertifikasi.*') ? 'active' : '' }}"
                       href="{{ route('sertifikasi.index') }}">
                        Sertifikasi
                    </a>
                </li>

                {{-- Hubungi Kami — CTA button --}}
                <li class="nav-item ms-lg-2">
                    <a class="btn-navbar-cta {{ request()->routeIs('hubungi-kami') ? 'active' : '' }}"
                       href="{{ route('hubungi-kami') }}">
                        Hubungi Kami
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>

{{-- ─── Navbar Styles ─── --}}
<style>
/* Navbar wrapper */
#mainNavbar {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    padding: 0.75rem 0;
    transition: box-shadow 0.25s ease;
}

#mainNavbar.scrolled {
    box-shadow: 0 2px 20px rgba(0,0,0,0.07);
}

/* Brand */
.navbar-brand {
    text-decoration: none;
}

.brand-name {
    font-size: 0.95rem;
    font-weight: 700;
    color: #00998a;
    line-height: 1.2;
    letter-spacing: 0.01em;
}

.brand-sub {
    font-size: 0.68rem;
    font-weight: 400;
    color: #374151;
    line-height: 1.3;
    letter-spacing: 0.01em;
}

/* Nav links */
.nav-link-custom {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    text-decoration: none;
    padding: 0.45rem 0.9rem;
    border-radius: 8px;
    display: block;
    transition: color 0.2s ease, background 0.2s ease;
    letter-spacing: 0.01em;
}

.nav-link-custom:hover {
    color: #00998a;
    background: #e6f7f5;
}

.nav-link-custom.active {
    color: #00998a;
    font-weight: 600;
}

/* Dropdown toggle caret */
.nav-link-custom.dropdown-toggle::after {
    display: inline-block;
    width: 0;
    height: 0;
    margin-left: 0.4em;
    vertical-align: 0.18em;
    content: "";
    border-top: 0.3em solid currentColor;
    border-right: 0.3em solid transparent;
    border-left: 0.3em solid transparent;
    border-bottom: 0;
    opacity: 0.55;
    transition: transform 0.2s ease;
}

/* .nav-item.dropdown:hover > .nav-link-custom.dropdown-toggle::after,
.nav-link-custom.dropdown-toggle[aria-expanded="true"]::after {
    transform: rotate(-180deg);
} */

/* Dropdown menu */
.dropdown-menu-custom {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 0.5rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.10);
    min-width: 220px;
    margin-top: 0.4rem;
    background: #ffffff;
}

.dropdown-item-custom {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.875rem;
    font-weight: 400;
    color: #374151;
    padding: 0.55rem 0.85rem;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.18s ease, color 0.18s ease;
    line-height: 1.4;
}

.dropdown-item-custom:hover {
    background: #e6f7f5;
    color: #00998a;
}

.dropdown-item-custom.active {
    background: #e6f7f5;
    color: #00998a;
    font-weight: 600;
}

.dropdown-icon {
    font-size: 0.85rem;
    width: 20px;
    text-align: center;
    flex-shrink: 0;
    opacity: 0.75;
}

/* CTA button */
.btn-navbar-cta {
    display: inline-flex;
    align-items: center;
    font-size: 0.85rem;
    font-weight: 600;
    color: #ffffff !important;
    background: #00998a;
    border: none;
    padding: 0.5rem 1.25rem;
    border-radius: 50px;
    text-decoration: none;
    letter-spacing: 0.01em;
    transition: background 0.22s ease, transform 0.22s ease, box-shadow 0.22s ease;
    white-space: nowrap;
}

.btn-navbar-cta:hover {
    background: #006b5e;
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(0,153,138,0.28);
}

.btn-navbar-cta.active {
    background: #006b5e;
}

/* Custom hamburger */
.navbar-toggler-custom {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    background: none;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 0.45rem 0.6rem;
    cursor: pointer;
    transition: border-color 0.2s ease;
}

.navbar-toggler-custom span {
    display: block;
    width: 20px;
    height: 2px;
    background: #374151;
    border-radius: 99px;
    transition: all 0.25s ease;
}

.navbar-toggler-custom:hover {
    border-color: #00998a;
}


/* Mobile */
@media (max-width: 1199.98px) {
    .navbar-toggler-custom {
        display: flex;
    }

    .navbar-collapse {
        margin-top: 0.75rem;
        padding: 1rem;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
    }

    /* Tambahkan ini */
    .navbar-nav {
        align-items: flex-start !important;  /* override ms-auto centering */
        width: 100%;
    }

    .nav-item {
        width: 100%;
    }

    .nav-link-custom {
        padding: 0.6rem 0.75rem;
        width: 100%;
    }

    .dropdown-menu-custom {
        border: none;
        box-shadow: none;
        padding: 0 0 0 1rem;
        margin: 0;
        border-radius: 0;
        border-left: 2px solid #e5e7eb;
    }

    .btn-navbar-cta {
        margin-top: 0.5rem;
        width: 100%;
        justify-content: center;
    }
}
</style>

{{-- ─── Scroll shadow script ─── --}}
<script>
(function() {
    const nav = document.getElementById('mainNavbar');
    if (!nav) return;
    window.addEventListener('scroll', function() {
        nav.classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });
})();
</script>