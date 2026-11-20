@extends('layouts.fyne')

@section('title', 'FyneCine - Assistir Filmes e Séries Online Grátis Dublado em HD')

@section('seo')
    @php
        $siteName = \App\Models\AppConfig::getSettings()->app_name ?? 'FyneCine';
        $homeTitle = $siteName . ' - Assistir Filmes e Séries Online Grátis Dublado em HD';
        $homeDesc = 'Assista aos melhores filmes, lançamentos de cinema, séries completas e animes online grátis em Full HD dublado e legendado. Catálogo atualizado diariamente no ' . $siteName . '!';
        $homeImage = asset('img/logo.png');
    @endphp
    <meta name="description" content="{{ $homeDesc }}">
    <meta name="keywords" content="assistir filmes online, filmes gratis hd, assistir series online, series dubladas, animes online, lancamentos de cinema, filmes online dublado, pobreflix, superflix, redecanais, topflix">
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph / WhatsApp / Telegram / Facebook -->
    <meta property="og:title" content="{{ $homeTitle }}">
    <meta property="og:description" content="{{ $homeDesc }}">
    <meta property="og:image" content="{{ $homeImage }}">
    <meta property="og:image:secure_url" content="{{ $homeImage }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $homeTitle }}">
    <meta name="twitter:description" content="{{ $homeDesc }}">
    <meta name="twitter:image" content="{{ $homeImage }}">

    <!-- Google Sitelinks Searchbox (Schema.org JSON-LD) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@type": "WebSite",
      "name": "{{ $siteName }}",
      "url": "{{ url('/') }}",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ url('/busca') }}?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
@endsection

@section('nav_home_active', 'active')

@section('styles')
<style>
    body {
        padding-top: 0;
    }

    /* ----- CARROSSEL HERO (MODERNO & CINEMATOGRÁFICO) ----- */
    .hero-slider {
        position: relative;
        width: calc(100% - 40px);
        height: 52vw;
        max-height: 480px;
        min-height: 300px;
        overflow: hidden;
        border-radius: 20px;
        margin: 12px 20px 32px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.9);
    }
    .slides-wrapper {
        display: flex;
        width: 100%;
        height: 100%;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .slide {
        min-width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center 25%;
        position: relative;
        display: flex;
        align-items: flex-end;
        padding: 36px 32px;
    }
    .slide::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(0deg, #000000 0%, rgba(0,0,0,0.88) 35%, rgba(0,0,0,0.3) 70%, transparent 100%),
                    linear-gradient(90deg, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.55) 45%, transparent 80%);
    }
    .slide-content {
        position: relative;
        z-index: 2;
        max-width: 440px;
        width: 100%;
    }
    .slide-content .badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: #f1f5f9;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .slide-content h2 {
        font-size: 32px;
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 8px;
        color: #ffffff;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
    }
    .slide-content p {
        font-size: 14px;
        color: #cbd5e1;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 16px;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.8);
    }
    .slide-content .meta-mini {
        display: none;
    }
    .btn-play {
        background: #ffffff;
        color: #0b0b0f;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }
    .btn-play:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 255, 255, 0.2);
        color: #000;
    }
    .slider-dots {
        position: absolute;
        bottom: 16px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
        z-index: 5;
    }
    .slider-dots span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .slider-dots span.active {
        background: #ffffff;
        width: 22px;
        border-radius: 10px;
    }

    /* Slider responsive */
    @media (max-width: 600px) {
        .hero-slider {
            height: 60vw;
            max-height: 320px;
            margin: 8px 12px 20px;
            width: calc(100% - 24px);
            border-radius: 16px;
        }
        .slide {
            padding: 16px 18px;
            align-items: flex-end;
        }
        .slide-content { max-width: 100%; }
        .slide-content h2 { font-size: 22px; }
        .slide-content p { font-size: 12px; margin-bottom: 12px; }
        .btn-play { padding: 8px 18px; font-size: 13px; }
    }
        .slide-content .badge,
        .slide-content p { display: none; }
        .slide-content h2 {
            font-size: 18px;
            margin-bottom: 2px;
            line-height: 1.2;
        }
        .slide-content .meta-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            color: #cbd5e0;
            margin-bottom: 4px;
        }
        .slide-content .meta-mini .avaliacao {
            display: flex;
            align-items: center;
            gap: 3px;
            color: #fbbf24;
        }
        .btn-play { padding: 5px 16px; font-size: 12px; gap: 4px; }
        .slider-dots { bottom: 8px; }
        .slider-dots span { width: 6px; height: 6px; }
        .slider-dots span.active { width: 18px; }
    }
    @media (min-width: 601px) and (max-width: 1024px) {
        .hero-slider { height: 45vw; max-height: 380px; }
        .slide-content h2 { font-size: 26px; }
    }
    @media (min-width: 1025px) {
        .hero-slider {
            max-height: 480px;
            margin: 16px 40px 36px;
            width: calc(100% - 80px);
            border-radius: 28px;
        }
        .slide-content { max-width: 420px; }
        .slide-content h2 { font-size: 36px; }
        .slide-content p { font-size: 15px; -webkit-line-clamp: 3; }
        .btn-play { padding: 10px 32px; font-size: 16px; }
    }

    /* ----- SEÇÕES ----- */
    .section {
        padding: 0 20px 32px;
        animation: fadeUp 0.5s ease both;
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .section-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .section-header h3 {
        font-size: 20px;
        font-weight: 700;
        color: #f0f2f5;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-header h3 i { color: #a855f7; }
    .ver-todos {
        font-size: 13px;
        color: #8a94a6;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        white-space: nowrap;
    }
    .ver-todos:hover { color: #a855f7; }

    /* ----- SCROLL HORIZONTAL (cards) ----- */
    .scroll-horizontal {
        display: flex;
        gap: 14px;
        overflow-x: auto;
        padding-bottom: 8px;
        scroll-snap-type: x proximity;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }
    .scroll-horizontal::-webkit-scrollbar { display: none; }

    /* ----- CARD (MODERNO SEM BORDA ROXA) ----- */
    .card {
        flex: 0 0 130px;
        width: 130px;
        scroll-snap-align: start;
        border-radius: 10px;
        overflow: hidden;
        background: #111116;
        transition: transform 0.25s cubic-bezier(0.2, 0, 0, 1), box-shadow 0.25s cubic-bezier(0.2, 0, 0, 1), border-color 0.25s;
        cursor: pointer;
        position: relative;
        aspect-ratio: 2 / 3;
        border: 1px solid rgba(255, 255, 255, 0.06);
    }
    .card:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.95);
        border-color: rgba(255, 255, 255, 0.22);
        z-index: 2;
    }
    .card-img {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.35s ease;
    }
    .card:hover .card-img { transform: scale(1.05); }

    @media (max-width: 600px) {
        .card { flex: 0 0 105px; width: 105px; border-radius: 10px; }
        .section { padding: 0 12px 24px; }
        .scroll-horizontal { gap: 10px; }
        .section-header h3 { font-size: 17px; }
    }
    @media (min-width: 601px) {
        .card { flex: 0 0 155px; width: 155px; }
    }
    @media (min-width: 1025px) {
        .card { flex: 0 0 180px; width: 180px; }
        .section { padding: 0 40px 36px; }
    }
</style>
@endsection

@section('content')

    <!-- ===== HERO SLIDER ===== -->
    @if($sliders->isNotEmpty())
    <section class="hero-slider" id="heroSlider">
        <div class="slides-wrapper" id="slidesWrapper">
            @foreach($sliders as $index => $slider)
                @php
                    $content = $slider->content_type === 'movie' ? $slider->movie : $slider->serie;
                    if (!$content) continue;
                    $title = $content->title ?? $content->name;
                    $image = $content->backdrop_path
                        ? 'https://image.tmdb.org/t/p/w1280' . $content->backdrop_path
                        : asset('img/no-backdrop.jpg');
                    $url = $slider->content_type === 'movie'
                        ? route('frontend.movie', $content->slug)
                        : route('frontend.serie', $content->slug);
                    $nota = $content->rating ?? $content->vote_average ?? 0;
                    $ano = $content->release_year ?? $content->first_air_year ?? '';
                    $duracao = $content->runtime ?? 0;
                    $overview = $content->overview ?? '';
                    $tipo = $slider->content_type === 'movie' ? 'Filme' : 'Série';
                @endphp
                <div class="slide" style="background-image: url('{{ $image }}')">
                    <div class="slide-content">
                        <span class="badge">{{ $tipo }}</span>
                        <h2>{{ $title }}</h2>
                        <p>{{ $overview }}</p>
                        <div class="meta-mini">
                            <span class="avaliacao"><i class="fas fa-star"></i> {{ number_format($nota, 1) }}</span>
                            @if($ano)<span>{{ $ano }}</span>@endif
                            @if($duracao)<span>{{ $duracao }} min</span>@endif
                        </div>
                        <a href="{{ $url }}" class="btn-play"><i class="fas fa-play"></i> Assistir</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="slider-dots" id="sliderDots">
            @foreach($sliders as $index => $slider)
                @if($slider->movie || $slider->serie)
                    <span class="{{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
                @endif
            @endforeach
        </div>
    </section>
    @endif

    <!-- ===== SEÇÕES DINÂMICAS ===== -->
    @foreach($sections as $sectionIdx => $section)
        @php
            $items = $section->resolveItems();
            if ($items->isEmpty()) continue;

            // Ícone baseado no tipo da seção
            $icon = match($section->type) {
                'trending', 'top_10' => 'fas fa-fire',
                'recently_added'     => 'fas fa-clock',
                'genre'              => 'fas fa-tag',
                'network'            => 'fas fa-tv',
                'upcoming'           => 'fas fa-hourglass-half',
                'events'             => 'fas fa-calendar',
                default              => 'fas fa-play-circle',
            };

            // URL "Ver Todos" com filtros pré-aplicados
            $verTodosUrl = match(true) {
                $section->type === 'genre' && $section->genre => route('frontend.search', [
                    'genero'    => $section->genre->slug,
                    'categoria' => match($section->content_type) {
                        'movie'  => 'filmes',
                        'series' => 'series',
                        default  => 'todos',
                    }
                ]),
                $section->content_type === 'movie' => route('frontend.search', ['categoria' => 'filmes']),
                $section->content_type === 'series' => route('frontend.search', ['categoria' => 'series']),
                default => route('frontend.search'),
            };
        @endphp

        <section class="section" style="animation-delay: {{ $sectionIdx * 0.08 }}s">
            <div class="section-header">
                <h3><i class="{{ $icon }}"></i> {{ $section->title }}</h3>
                <a href="{{ $verTodosUrl }}" class="ver-todos">Ver todos →</a>
            </div>

            <div class="scroll-horizontal">
                @foreach($items as $item)
                    @php
                        // Pula itens que não são filmes/séries (ex: events, upcoming, networks)
                        $isMovie = isset($item->title) && isset($item->slug);
                        $isSerie = isset($item->name) && isset($item->slug);
                        if (!$isMovie && !$isSerie) continue;

                        $itemTitle   = $isMovie ? $item->title : $item->name;
                        $itemImage   = $item->poster_path
                            ? 'https://image.tmdb.org/t/p/w500' . $item->poster_path
                            : asset('img/no-poster.jpg');
                        $itemBackdrop = $item->backdrop_path
                            ? 'https://image.tmdb.org/t/p/w780' . $item->backdrop_path
                            : '';
                        $itemUrl     = $isMovie
                            ? route('frontend.movie', $item->slug)
                            : route('frontend.serie', $item->slug);
                        $itemNota    = $item->rating ?? $item->vote_average ?? 0;
                        $itemAno     = $isMovie
                            ? ($item->release_year ?? ($item->release_date ? date('Y', strtotime($item->release_date)) : ''))
                            : ($item->first_air_year ?? ($item->first_air_date ? date('Y', strtotime($item->first_air_date)) : ''));
                        $itemDuracao = $isMovie ? ($item->runtime ?? 0) : 0;
                        $itemSinopse = $item->overview ?? 'Sinopse não disponível.';
                    @endphp
                    <div class="card"
                         data-titulo="{{ $itemTitle }}"
                         data-ano="{{ $itemAno }}"
                         data-nota="{{ $itemNota }}"
                         data-duracao="{{ $itemDuracao }}"
                         data-img="{{ $itemImage }}"
                         data-backdrop="{{ $itemBackdrop }}"
                         data-sinopse="{{ $itemSinopse }}"
                         data-url="{{ $itemUrl }}"
                         onclick="window.location.href='{{ $itemUrl }}'">
                        <div class="card-img" style="background-image: url('{{ $itemImage }}')"></div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

@endsection

@section('scripts')
<script>
    // ----- CARROSSEL (SLIDER) -----
    const slidesWrapper = document.getElementById('slidesWrapper');
    const dots = document.querySelectorAll('#sliderDots span');
    let currentSlide = 0;
    const totalSlides = dots.length;
    let autoSlideInterval;

    function goToSlide(index) {
        if (totalSlides <= 1) return;
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        currentSlide = index;
        slidesWrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, i) => dot.classList.toggle('active', i === currentSlide));
    }

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            goToSlide(parseInt(dot.dataset.index));
            resetAutoSlide();
        });
    });

    function nextSlide() { goToSlide(currentSlide + 1); }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        if (totalSlides > 1) autoSlideInterval = setInterval(nextSlide, 6000);
    }

    if (totalSlides > 1) {
        autoSlideInterval = setInterval(nextSlide, 6000);
        const hero = document.getElementById('heroSlider');
        if (hero) {
            hero.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
            hero.addEventListener('mouseleave', () => { autoSlideInterval = setInterval(nextSlide, 6000); });
        }
    }
</script>
@endsection
