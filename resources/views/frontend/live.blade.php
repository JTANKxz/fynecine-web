@extends('layouts.fyne')

@section('title', 'Live TV – Canais ao Vivo, Esportes e Filmes | FyneCine')

@section('seo')
    @php
        $seoTitle = 'Live TV – Canais ao Vivo, Esportes e Filmes | FyneCine';
        $seoDesc = 'Assista canais ao vivo, esportes e filmes 24h diretamente no FyneCine. Transmissão para TV, esportes ao vivo e canais temáticos em alta qualidade.';
        $seoImage = asset('img/live-thumbnail.jpg');
    @endphp
    <meta name="description" content="{{ $seoDesc }}">
    <meta name="keywords" content="live tv, canais ao vivo, esportes ao vivo, canais de filmes 24h, transmissão para tv, fynecine">
    <link rel="canonical" href="{{ url('/live') }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:url" content="{{ url('/live') }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDesc }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "WebPage",
        "name": "{{ $seoTitle }}",
        "description": "{{ $seoDesc }}",
        "url": "{{ url('/live') }}",
        "image": "{{ $seoImage }}"
    }
    </script>
@endsection

@section('styles')
    <style>
        .live-section {
            max-width: 1040px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .live-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .live-card {
            background: #0d0d12;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            color: #e2e8f0;
        }
        .live-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 8px;
        }
        .live-card h4 {font-size: 15px; margin: 8px 0; color: #f1f5f9;}
    </style>
@endsection

@section('content')
<div class="live-section">
    <h2 class="text-2xl font-bold text-white mb-6">Canais ao Vivo</h2>
    <div class="live-grid">
        <!-- Placeholder cards – replace with real channel data -->
        @for ($i = 1; $i <= 6; $i++)
        <div class="live-card">
            <img src="{{ asset('img/placeholder-live.jpg') }}" alt="Canal {{ $i }}">
            <h4>Canal {{ $i }}</h4>
            <p>Esportes / Filmes / Geral</p>
        </div>
        @endfor
    </div>
</div>
@endsection
