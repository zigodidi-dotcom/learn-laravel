'use strict';

/* ══════════════════════════════════════════════════════
   Laravel Cheat Sheet — App JS
   ══════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initSidebar();
    initNavigation();
    initSearch();
});

/* ─── THEME ───────────────────────────────────────────── */
function initTheme() {
    const KEY = 'cs-theme';
    const root = document.documentElement;

    const saved = localStorage.getItem(KEY);
    const preferred = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    const theme = saved || preferred;

    root.dataset.theme = theme;

    document.getElementById('themeToggle')?.addEventListener('click', () => {
        const next = root.dataset.theme === 'dark' ? 'light' : 'dark';
        root.dataset.theme = next;
        localStorage.setItem(KEY, next);
    });
}

/* ─── SIDEBAR ─────────────────────────────────────────── */
function initSidebar() {
    const KEY = 'cs-sidebar';
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar) return;

    const isMobile = () => window.innerWidth <= 768;

    // Desktop collapse state
    if (!isMobile() && localStorage.getItem(KEY) === 'collapsed') {
        sidebar.classList.add('collapsed');
    }

    toggle?.addEventListener('click', () => {
        if (isMobile()) return;
        sidebar.classList.toggle('collapsed');
        localStorage.setItem(KEY, sidebar.classList.contains('collapsed') ? 'collapsed' : 'open');
    });

    // Mobile drawer
    const openMobile = () => {
        sidebar.classList.add('mobile-open');
        overlay.classList.add('visible');
    };
    const closeMobile = () => {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('visible');
    };

    mobileBtn?.addEventListener('click', openMobile);
    overlay?.addEventListener('click', closeMobile);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('mobile-open')) closeMobile();
    });
}

/* ─── NAVIGATION ──────────────────────────────────────── */
function initNavigation() {
    const navItems = document.querySelectorAll('.nav-item[data-filter]');
    const sections  = document.querySelectorAll('.category-section');
    const viewAll   = document.getElementById('view-all');
    const viewGlossary = document.getElementById('view-glossary');
    const titleEl   = document.getElementById('currentSectionTitle');

    function setActive(btn) {
        navItems.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    function applyFilter(filter) {
        if (filter === 'glossary') {
            viewAll.style.display = 'none';
            viewGlossary.style.display = 'block';
            if (titleEl) titleEl.textContent = 'Glossaire Laravel';
            return;
        }

        viewAll.style.display = 'block';
        viewGlossary.style.display = 'none';

        sections.forEach(section => {
            if (filter === 'all' || section.dataset.category === filter) {
                section.style.display = 'block';
                if (titleEl) {
                    titleEl.textContent = filter === 'all'
                        ? 'Toutes les fonctionnalités'
                        : section.querySelector('.category-name')?.textContent || filter;
                }
            } else {
                section.style.display = 'none';
            }
        });
    }

    navItems.forEach(btn => {
        btn.addEventListener('click', () => {
            setActive(btn);
            applyFilter(btn.dataset.filter);
            // Close mobile sidebar after navigation
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar')?.classList.remove('mobile-open');
                document.getElementById('sidebarOverlay')?.classList.remove('visible');
            }
        });
    });
}

/* ─── SEARCH ──────────────────────────────────────────── */
function initSearch() {
    const overlay = document.getElementById('searchOverlay');
    const input   = document.getElementById('searchInput');
    const results = document.getElementById('searchResults');
    const empty   = document.getElementById('searchEmpty');
    const triggers = [document.getElementById('searchBar')];

    // Parse data island
    let features = [];
    let terms = [];
    try {
        const raw = JSON.parse(document.getElementById('appData')?.textContent || '{}');
        features = raw.features || [];
        terms    = raw.terms    || [];
    } catch (e) {
        console.error('Failed to parse appData', e);
    }

    // Open / close
    const openSearch = () => {
        overlay.classList.add('open');
        input.focus();
        input.select();
    };

    const closeSearch = () => {
        overlay.classList.remove('open');
        input.value = '';
        renderEmpty();
    };

    triggers.forEach(t => t?.addEventListener('click', openSearch));
    document.getElementById('searchClose')?.addEventListener('click', closeSearch);
    overlay.addEventListener('click', (e) => { if (e.target === overlay) closeSearch(); });

    // ⌘K / Ctrl+K
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            overlay.classList.contains('open') ? closeSearch() : openSearch();
        }
        if (e.key === 'Escape' && overlay.classList.contains('open')) closeSearch();
    });

    // Search logic
    let debounceTimer;
    let focusedIndex = -1;

    input.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            focusedIndex = -1;
            renderResults(input.value.trim());
        }, 180);
    });

    function renderEmpty() {
        results.innerHTML = '';
        results.appendChild(empty);
        empty.style.display = 'flex';
    }

    function highlight(text, query) {
        if (!query) return text;
        const escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        return text.replace(new RegExp(`(${escaped})`, 'gi'), '<mark>$1</mark>');
    }

    function renderResults(query) {
        if (!query) { renderEmpty(); return; }

        const q = query.toLowerCase();

        const matchedFeatures = features.filter(f =>
            f.name.toLowerCase().includes(q) ||
            f.description?.toLowerCase().includes(q) ||
            f.category?.toLowerCase().includes(q) ||
            f.tags?.some(t => t.name.toLowerCase().includes(q))
        ).slice(0, 12);

        const matchedTerms = terms.filter(t =>
            t.name.toLowerCase().includes(q) ||
            t.definition?.toLowerCase().includes(q)
        ).slice(0, 5);

        if (!matchedFeatures.length && !matchedTerms.length) {
            results.innerHTML = `
                <div class="search-empty">
                    <div class="search-empty-icon">🤔</div>
                    <p>Aucun résultat pour <strong>${query}</strong></p>
                    <p class="search-empty-hint">Essayez un terme différent</p>
                </div>`;
            return;
        }

        let html = '';

        if (matchedFeatures.length) {
            html += `<div class="search-section-header">Features (${matchedFeatures.length})</div>`;
            matchedFeatures.forEach((f, i) => {
                html += `
                <div class="search-result-item" data-index="${i}" data-type="feature" data-slug="${f.slug}" data-category="${f.categorySlug}">
                    <div class="result-icon">🔖</div>
                    <div class="result-body">
                        <div class="result-name">${highlight(f.name, query)}</div>
                        <div class="result-desc">${f.description?.substring(0, 90)}…</div>
                        <div class="result-meta">
                            <span class="result-category-tag">${f.category}</span>
                            <span class="badge badge-${f.difficulty}">${f.difficulty}</span>
                        </div>
                    </div>
                </div>`;
            });
        }

        if (matchedTerms.length) {
            html += `<div class="search-section-header">Glossaire (${matchedTerms.length})</div>`;
            matchedTerms.forEach((t, i) => {
                html += `
                <div class="search-result-item" data-index="${matchedFeatures.length + i}" data-type="term" data-slug="${t.slug}">
                    <div class="result-icon">📚</div>
                    <div class="result-body">
                        <div class="result-name">${highlight(t.name, query)}</div>
                        <div class="result-desc">${t.definition?.substring(0, 90)}…</div>
                    </div>
                </div>`;
            });
        }

        results.innerHTML = html;

        // Click handlers
        results.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', () => {
                closeSearch();
                if (item.dataset.type === 'feature') {
                    navigateToFeature(item.dataset.slug, item.dataset.category);
                } else {
                    navigateToTerm(item.dataset.slug);
                }
            });
        });
    }

    // Keyboard navigation
    input.addEventListener('keydown', (e) => {
        const items = results.querySelectorAll('.search-result-item');
        if (!items.length) return;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            focusedIndex = Math.min(focusedIndex + 1, items.length - 1);
            updateFocus(items);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            focusedIndex = Math.max(focusedIndex - 1, 0);
            updateFocus(items);
        } else if (e.key === 'Enter' && focusedIndex >= 0) {
            items[focusedIndex]?.click();
        }
    });

    function updateFocus(items) {
        items.forEach(item => item.classList.remove('focused'));
        if (focusedIndex >= 0) {
            items[focusedIndex].classList.add('focused');
            items[focusedIndex].scrollIntoView({ block: 'nearest' });
        }
    }

    function navigateToFeature(slug, categorySlug) {
        // Switch to category view
        const navBtn = document.querySelector(`.nav-item[data-filter="${categorySlug}"]`);
        navBtn?.click();

        // Wait for display then scroll
        setTimeout(() => {
            const el = document.getElementById(`feature-${slug}`);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                el.classList.add('highlight');
                setTimeout(() => el.classList.remove('highlight'), 2500);
            }
        }, 50);
    }

    function navigateToTerm(slug) {
        const glossaryBtn = document.querySelector('.nav-item[data-filter="glossary"]');
        glossaryBtn?.click();

        setTimeout(() => {
            const el = document.getElementById(`term-${slug}`);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                el.classList.add('highlight');
                setTimeout(() => el.classList.remove('highlight'), 2500);
            }
        }, 50);
    }

    renderEmpty();
}
