<style>
/* ─── Breadcrumb ─── */
.breadcrumb-custom {
    background: none; padding: 0; margin-bottom: 1.1rem; font-size: 0.82rem;
}
.breadcrumb-custom .breadcrumb-item a {
    color: #00998a; text-decoration: none; font-weight: 500; transition: color 0.2s;
}
.breadcrumb-custom .breadcrumb-item a:hover { color: #006b5e; }
.breadcrumb-custom .breadcrumb-item.active { color: #9ca3af; }
.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #d1d5db; }

/* ─── Typography ─── */
.section-eyebrow {
    display: inline-block; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: #00998a; background: #e6f7f5;
    border: 1px solid rgba(0,153,138,0.18); padding: 0.22rem 0.8rem; border-radius: 50px;
}
.section-title {
    font-size: clamp(1.5rem, 3vw, 1.85rem); font-weight: 700; color: #111827;
    letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 0.3rem;
}
.section-subtitle { font-size: 0.95rem; color: #6b7280; margin: 0; }
.put-abbr { font-size: 1rem; font-weight: 600; color: #00998a; }
.article-title {
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 700; color: #111827;
    line-height: 1.4; letter-spacing: -0.02em; margin: 0.75rem 0 1rem; text-align: justify;
}
.article-meta {
    display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1.75rem;
}

.date-badge {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.78rem; font-weight: 500; color: #9ca3af;
}

.date-sep { color: #d1d5db; font-size: 0.75rem; }

/* ─── Hero image ─── */
.article-hero-img {
    width: 100%; border-radius: 14px; overflow: hidden; position: relative;
    margin-bottom: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08);
}
.article-hero-img img {
    width: 100%; max-height: 400px; object-fit: cover; display: block;
}

/* ─── Desc box ─── */
.produk-desc-box {
    background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px; padding: 1.75rem;
}
.produk-desc-title {
    font-size: 1rem; font-weight: 700; color: #111827;
    display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;
}
.produk-desc-title i { color: #00998a; }

/* ─── Article body ─── */
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

/* ─── Kategori section ─── */
.kategori-section { margin-bottom: 1rem; }
.kategori-header {
    display: flex; justify-content: space-between; align-items: flex-end;
    gap: 1rem; flex-wrap: wrap; margin-bottom: 1.75rem;
}
.kategori-header-left { flex: 1; }
.kategori-count {
    display: inline-flex; align-items: center; gap: 0.35rem;
    font-size: 0.8rem; color: #9ca3af; font-weight: 500; margin: 0.25rem 0 0;
}
.kategori-divider { border: none; border-top: 1px solid #e5e7eb; margin: 3.5rem 0; }

/* ─── Content Card ─── */
.content-card {
    background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px;
    overflow: hidden; display: flex; flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
}
.content-card:hover {
    transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0,0,0,0.11); border-color: transparent;
}
.content-card-thumb { width: 100%; height: 200px; overflow: hidden; flex-shrink: 0; position: relative; }
.content-card-thumb img {
    width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.35s ease;
}

.content-card-thumb-placeholder {
    width: 100%; height: 100%; background: #f3f4f6;
    display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2.5rem;
}
.content-card-body { padding: 1.25rem 1.35rem 1.5rem; display: flex; flex-direction: column; flex: 1; }
.card-chip {
    position: absolute; top: 0.6rem; right: 0.6rem; z-index: 1;
    display: inline-block; font-size: 0.68rem; font-weight: 700;
    letter-spacing: 0.07em; text-transform: uppercase; color: #00998a;
    background: rgba(255,255,255,0.92); backdrop-filter: blur(4px);
    border: 1px solid rgba(0,153,138,0.2); padding: 0.16rem 0.6rem;
    border-radius: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.content-card-title {
    font-size: 0.925rem; font-weight: 600; color: #111827;
    line-height: 1.45; letter-spacing: -0.01em; margin: 0 0 0.5rem; text-align: justify;
}
.content-card-title a { color: inherit; text-decoration: none; transition: color 0.2s; }
.content-card-title a:hover { color: #00998a; }
.content-card-excerpt {
    font-size: 0.845rem; color: #6b7280; line-height: 1.65; margin: 0; flex: 1; text-align: justify;
}

/* ─── Search ─── */
.search-wrapper { max-width: auto; }
.search-box { position: relative; display: flex; align-items: center; }
.search-icon { position: absolute; left: 1rem; color: #9ca3af; font-size: 0.9rem; pointer-events: none; }
.search-input {
    width: 100%; padding: 0.65rem 2.8rem 0.65rem 2.6rem;
    border: 1px solid #e5e7eb; border-radius: 10px;
    font-size: 0.875rem; font-family: "Poppins", sans-serif;
    color: #111827; background: #ffffff; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.search-input:focus { border-color: #00998a; box-shadow: 0 0 0 3px rgba(0,153,138,0.1); }
.search-clear { position: absolute; right: 0.85rem; color: #9ca3af; font-size: 0.75rem; text-decoration: none; transition: color 0.2s; }
.search-clear:hover { color: #ef4444; }
.search-result-info { font-size: 0.82rem; color: #6b7280; margin-top: 0.6rem; margin-bottom: 0; }

/* ─── Poster ─── */
.poster-wrap {
    background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px;
    padding: 1.25rem; height: 100%; display: flex; flex-direction: column;
}
.poster-label { font-size: 0.95rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; }
.poster-label i { color: #00998a; }
.poster-img { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; flex: 1; min-height: 0; cursor: zoom-in; transition: opacity 0.2s; }
.poster-img:hover { opacity: 0.9; }
/* ───  ─── */
.poster-card {
    position: relative; border-radius: 10px; overflow: hidden; cursor: pointer;
    aspect-ratio: 3/4; background: #f3f4f6; border: 1px solid #e5e7eb;
    transition: transform 0.22s ease, box-shadow 0.22s ease;
}
.poster-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }
.poster-card img { width: 100%; height: 100%; object-fit: cover; display: block; }
.poster-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0);
    display: flex; align-items: center; justify-content: center; transition: background 0.22s;
}
.poster-overlay i { font-size: 1.75rem; color: #fff; opacity: 0; transition: opacity 0.22s; }
.poster-card:hover .poster-overlay { background: rgba(0,0,0,0.35); }
.poster-card:hover .poster-overlay i { opacity: 1; }

/* ─── Galeri Carousel ─── */
.galeri-section {
    background: #f9fafb; border: 1px solid #e5e7eb;
    border-radius: 14px; padding: 1.5rem; margin-bottom: 2rem;
}
.galeri-title {
    font-size: 0.95rem; font-weight: 700; color: #111827;
    display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;
}
.galeri-title i { color: #00998a; }
.galeri-carousel-img {
    width: 100%; height: 340px; object-fit: cover; display: block; border-radius: 10px;
}
.galeri-arrow {
    width: 38px; height: 38px; background: rgba(255,255,255,0.9);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    color: #111827; font-size: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.carousel-control-prev { left: 0.75rem; width: auto; }
.carousel-control-next { right: 0.75rem; width: auto; }
.carousel-control-prev-icon, .carousel-control-next-icon { display: none; }
.galeri-counter {
    position: absolute; bottom: 0.75rem; right: 0.85rem;
    background: rgba(0,0,0,0.45); color: #fff;
    font-size: 0.75rem; font-weight: 600; padding: 0.2rem 0.65rem;
    border-radius: 50px; backdrop-filter: blur(4px);
}

/* ─── Lightbox ─── */
.lightbox-overlay {
    display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.88);
    z-index: 9999; align-items: center; justify-content: center;
    padding: 1.5rem; backdrop-filter: blur(6px);
}
.lightbox-trigger { cursor: zoom-in; }
.lightbox-overlay.active .lightbox-img { animation: zoomIn 0.2s ease; }
.lightbox-overlay.active { display: flex; animation: fadeIn 0.2s ease; }
.lightbox-img {
    max-width: 90vw; max-height: 90vh; object-fit: contain;
    border-radius: 10px; box-shadow: 0 8px 40px rgba(0,0,0,0.5); animation: zoomIn 0.2s ease;
}
.lightbox-close {
    position: absolute; top: 1rem; right: 1.25rem;
    background: rgba(255,255,255,0.15); border: none; color: #fff;
    font-size: 1.2rem; width: 40px; height: 40px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center; cursor: pointer;
}
.lightbox-close:hover { background: rgba(255,255,255,0.3); }

/* ─── Related ─── */
.related-section { margin-top: 4rem; padding-top: 3rem; border-top: 1px solid #e5e7eb; }
.related-header { margin-bottom: 1.75rem; }

/* ─── Btn lihat semua ─── */
.btn-lihat-semua {
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-size: 0.82rem; font-weight: 600; color: #00998a;
    border: 1.5px solid rgba(0,153,138,0.35); background: transparent;
    padding: 0.42rem 1.1rem; border-radius: 50px; text-decoration: none; white-space: nowrap;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.btn-lihat-semua:hover { background: #e6f7f5; color: #006b5e; border-color: #00998a; }

/* ─── Empty state ─── */
.empty-state {
    text-align: center; padding: 3rem 2rem; color: #9ca3af;
}
.empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.75rem; }
.empty-state p { margin: 0; font-size: 0.9rem; }

/* ─── Pagination ─── */
.pagination-wrapper .pagination { gap: 0.3rem; margin: 0; }
.pagination-wrapper .page-link {
    font-family: "Poppins", sans-serif; font-size: 0.85rem; font-weight: 500;
    color: #374151; background: #ffffff; border: 1px solid #e5e7eb;
    border-radius: 8px !important; padding: 0.45rem 0.85rem;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.pagination-wrapper .page-link:hover { background: #e6f7f5; color: #00998a; border-color: rgba(0,153,138,0.3); }
.pagination-wrapper .page-item.active .page-link {
    background: #00998a; border-color: #00998a; color: #ffffff; font-weight: 600;
}
.pagination-wrapper .page-item.disabled .page-link {
    background: #f9fafb; color: #d1d5db; border-color: #e5e7eb;
}

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes zoomIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
</style>