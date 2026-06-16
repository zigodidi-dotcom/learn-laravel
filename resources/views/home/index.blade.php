@extends('layouts.app')

@section('title', 'Laravel Cheat Sheet — Référence complète')

@section('content')

{{-- ── VUE : TOUTES LES FEATURES ──────────────────────────────── --}}
<div id="view-all">
    @foreach($categories as $category)
    <section class="category-section" data-category="{{ $category->slug }}" id="cat-{{ $category->slug }}">
        <div class="category-header" style="--cat-color: {{ $category->color }}">
            <div class="category-title-row">
                <span class="category-icon">{{ $category->icon }}</span>
                <h2 class="category-name">{{ $category->name }}</h2>
                <span class="category-badge">{{ $category->features->count() }}</span>
            </div>
            @if($category->description)
            <p class="category-desc">{{ $category->description }}</p>
            @endif
        </div>

        <div class="features-grid">
            @foreach($category->features as $feature)
            <article class="feature-card" id="feature-{{ $feature->slug }}" data-category="{{ $category->slug }}">
                <div class="feature-header">
                    <h3 class="feature-name">{{ $feature->name }}</h3>
                    <div class="feature-meta">
                        <span class="badge badge-diff badge-{{ $feature->difficulty->value }}">
                            {{ $feature->difficulty->label() }}
                        </span>
                        <span class="badge badge-type">{{ $feature->type->label() }}</span>
                        @if($feature->since_version)
                        <span class="badge badge-version">{{ $feature->since_version }}</span>
                        @endif
                    </div>
                </div>

                <p class="feature-desc">{{ $feature->description }}</p>

                @if($feature->tags->isNotEmpty())
                <div class="feature-tags">
                    @foreach($feature->tags as $tag)
                    <span class="tag" style="--tag-color: {{ $tag->color }}">{{ $tag->name }}</span>
                    @endforeach
                </div>
                @endif

                @if($feature->examples->isNotEmpty())
                    @foreach($feature->examples as $example)
                    <details class="code-block">
                        <summary class="code-summary">
                            <span class="code-lang lang-{{ $example->language->value }}">{{ $example->language->value }}</span>
                            {{ $example->title }}
                        </summary>
                        @if($example->description)
                        <p class="code-desc">{{ $example->description }}</p>
                        @endif
                        <pre class="code-pre"><code class="lang-{{ $example->language->value }}">{{ $example->code }}</code></pre>
                    </details>
                    @endforeach
                @endif
            </article>
            @endforeach
        </div>
    </section>
    @endforeach
</div>

{{-- ── VUE : GLOSSAIRE ─────────────────────────────────────────── --}}
<div id="view-glossary" style="display:none">
    <div class="page-header">
        <h1 class="page-title">📚 Glossaire Laravel</h1>
        <p class="page-subtitle">{{ $terms->count() }} termes et concepts fondamentaux</p>
    </div>
    <div class="glossary-grid">
        @foreach($terms as $term)
        <article class="glossary-card" id="term-{{ $term->slug }}">
            <h3 class="glossary-term">{{ $term->name }}</h3>
            <p class="glossary-def">{{ $term->definition }}</p>
        </article>
        @endforeach
    </div>
</div>

@endsection
