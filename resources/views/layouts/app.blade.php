<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Cheat Sheet')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="app-shell">
    {{-- ── SIDEBAR ──────────────────────────────────────────── --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <span class="logo-icon">🔴</span>
                <span class="logo-text">Laravel</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" title="Réduire le menu">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M4.707 8l4.646-4.646a.5.5 0 0 0-.707-.708l-5 5a.5.5 0 0 0 0 .708l5 5a.5.5 0 0 0 .707-.708L4.707 8z"/>
                </svg>
            </button>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <button class="nav-item active" data-filter="all">
                    <span class="nav-icon">📖</span>
                    <span class="nav-label">Tout voir</span>
                    <span class="nav-count">{{ $categories->sum(fn($c) => $c->features->count()) }}</span>
                </button>
                <button class="nav-item" data-filter="glossary">
                    <span class="nav-icon">📚</span>
                    <span class="nav-label">Glossaire</span>
                    <span class="nav-count">{{ $terms->count() }}</span>
                </button>
            </div>

            <div class="nav-divider"></div>

            <div class="nav-section">
                @foreach($categories as $category)
                <button class="nav-item" data-filter="{{ $category->slug }}">
                    <span class="nav-icon">{{ $category->icon }}</span>
                    <span class="nav-label">{{ $category->name }}</span>
                    <span class="nav-count">{{ $category->features->count() }}</span>
                </button>
                @endforeach
            </div>
        </nav>

        <div class="sidebar-footer">
            <button class="theme-toggle" id="themeToggle" title="Basculer le thème">
                <span class="theme-icon-light">☀️</span>
                <span class="theme-icon-dark">🌙</span>
                <span class="theme-label">Thème</span>
            </button>
        </div>
    </aside>

    {{-- ── MOBILE OVERLAY ────────────────────────────────────── --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ── MAIN ─────────────────────────────────────────────── --}}
    <div class="main-wrapper">
        <header class="top-bar">
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
            <div class="top-bar-title" id="currentSectionTitle">Toutes les fonctionnalités</div>
            <div class="search-bar" id="searchBar" role="button" tabindex="0" aria-label="Rechercher (⌘K)">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="6.5" cy="6.5" r="5"/>
                    <path d="M10.5 10.5L14 14"/>
                </svg>
                <span class="search-placeholder">Rechercher…</span>
                <kbd class="search-kbd">⌘K</kbd>
            </div>
        </header>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</div>

{{-- ── SEARCH OVERLAY ───────────────────────────────────────── --}}
<div class="search-overlay" id="searchOverlay" role="dialog" aria-modal="true" aria-label="Recherche">
    <div class="search-modal">
        <div class="search-input-wrap">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="6.5" cy="6.5" r="5"/>
                <path d="M10.5 10.5L14 14"/>
            </svg>
            <input type="text" class="search-input" id="searchInput"
                   placeholder="Rechercher une feature, commande, concept…"
                   autocomplete="off" spellcheck="false">
            <button class="search-close" id="searchClose">Esc</button>
        </div>
        <div class="search-results" id="searchResults">
            <div class="search-empty" id="searchEmpty">
                <div class="search-empty-icon">🔍</div>
                <p>Commencez à taper pour chercher</p>
                <p class="search-empty-hint">Features, commandes, composants, concepts…</p>
            </div>
        </div>
    </div>
</div>

{{-- ── DATA ISLAND ──────────────────────────────────────────── --}}
<script id="appData" type="application/json">
{
    "features": [
        @foreach($categories as $category)
            @foreach($category->features as $feature)
            {
                "id": {{ $feature->id }},
                "name": {{ json_encode($feature->name) }},
                "slug": {{ json_encode($feature->slug) }},
                "description": {{ json_encode($feature->description) }},
                "category": {{ json_encode($category->name) }},
                "categorySlug": {{ json_encode($category->slug) }},
                "difficulty": {{ json_encode($feature->difficulty->value) }},
                "type": {{ json_encode($feature->type->value) }},
                "sinceVersion": {{ json_encode($feature->since_version) }},
                "tags": [
                    @foreach($feature->tags as $tag)
                    {"name": {{ json_encode($tag->name) }}, "color": {{ json_encode($tag->color) }}}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                ]
            }{{ !($loop->last && $loop->parent->last) ? ',' : '' }}
            @endforeach
        @endforeach
    ],
    "terms": [
        @foreach($terms as $term)
        {
            "id": {{ $term->id }},
            "name": {{ json_encode($term->name) }},
            "slug": {{ json_encode($term->slug) }},
            "definition": {{ json_encode($term->definition) }}
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
    ]
}
</script>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
