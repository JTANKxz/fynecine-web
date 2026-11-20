@extends('layouts.fyne')

@section('title', 'Baixar ' . ($settings->app_name ?? 'FyneCine') . ' APK Oficial - Filmes, Séries, Canais ao Vivo e Esportes para Android')
@section('nav_app_active', 'active')

@section('seo')
    @php
        $siteName = $settings->app_name ?? 'FyneCine';
        $appTitle = 'Baixar ' . $siteName . ' APK Oficial - Filmes, Séries, Canais ao Vivo e Esportes para Android';
        $appDesc = 'Baixe o aplicativo oficial ' . $siteName . ' APK para Android. Assista a filmes, séries, canais ao vivo, esportes e transmita para sua TV. Tudo grátis em Full HD!';
        $appImage = asset('img/logo.png');
    @endphp
    <meta name="description" content="{{ $appDesc }}">
    <meta name="keywords" content="baixar fynecine, fynecine apk, app filmes e series, aplicativo de filmes gratis android, canais ao vivo apk, app esportes ao vivo, transmitir para tv, filmes online apk">
    <link rel="canonical" href="{{ url('/baixar-app') }}">

    <!-- Open Graph / WhatsApp / Telegram -->
    <meta property="og:title" content="{{ $appTitle }}">
    <meta property="og:description" content="{{ $appDesc }}">
    <meta property="og:image" content="{{ $appImage }}">
    <meta property="og:image:secure_url" content="{{ $appImage }}">
    <meta property="og:url" content="{{ url('/baixar-app') }}">
    <meta property="og:type" content="website">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $appTitle }}">
    <meta name="twitter:description" content="{{ $appDesc }}">
    <meta name="twitter:image" content="{{ $appImage }}">

    <!-- Schema.org SoftwareApplication JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "SoftwareApplication",
      "name": "{{ $siteName }}",
      "operatingSystem": "Android 5.0 ou superior",
      "applicationCategory": "EntertainmentApplication",
      "fileFormat": "apk",
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "BRL"
      },
      "description": "{{ $appDesc }}"
    }
    </script>
@endsection

@section('styles')
<style>
    .app-hero-section {
        max-width: 1040px;
        margin: 20px auto 60px;
        padding: 0 20px;
    }

    .app-card-main {
        background: #0d0d12;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        padding: 48px 36px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.85);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .app-badge-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.25);
        color: #4ade80;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 20px;
        margin-bottom: 24px;
        letter-spacing: 0.3px;
    }

    .app-badge-status i {
        font-size: 10px;
    }

    .app-icon-wrapper {
        width: 88px;
        height: 88px;
        background: #181820;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
    }

    .app-icon-wrapper i {
        font-size: 42px;
        color: #38bdf8;
    }

    .app-hero-title {
        font-size: 34px;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.5px;
        line-height: 1.2;
        margin-bottom: 14px;
    }

    .app-hero-desc {
        font-size: 16px;
        color: #94a3b8;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto 32px;
    }

    .download-action-box {
        width: 100%;
        max-width: 440px;
        margin-bottom: 12px;
    }

    .btn-download-apk {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: #ffffff;
        color: #050508;
        padding: 16px 28px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.4);
        width: 100%;
        border: none;
        cursor: pointer;
    }

    .btn-download-apk:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(255, 255, 255, 0.15);
        color: #000;
    }

    .btn-download-apk i {
        font-size: 18px;
    }

    .app-meta-info {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        color: #64748b;
        font-size: 13px;
        margin-top: 14px;
    }

    .app-meta-info span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* Grid de Recursos (Clean & Minimalista) */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        width: 100%;
        margin-top: 40px;
        padding-top: 36px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }

    .feature-card {
        background: #121218;
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 22px 18px;
        text-align: left;
        transition: border-color 0.2s ease;
    }

    .feature-card:hover {
        border-color: rgba(255, 255, 255, 0.14);
    }

    .feature-card .icon-box {
        width: 38px;
        height: 38px;
        background: #1e1e28;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        color: #e2e8f0;
        font-size: 16px;
    }

    .feature-card h4 {
        font-size: 15px;
        font-weight: 700;
        color: #f1f5f9;
        margin-bottom: 6px;
    }

    .feature-card p {
        font-size: 13px;
        color: #94a3b8;
        line-height: 1.5;
        margin: 0;
    }

    /* Como Instalar Passo a Passo */
    .install-guide-section {
        max-width: 1040px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .install-guide-title {
        font-size: 20px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .steps-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .step-card {
        background: #0d0d12;
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 24px 20px;
        position: relative;
    }

    .step-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: #1e1e28;
        border-radius: 50%;
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 14px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .step-card h5 {
        font-size: 15px;
        font-weight: 700;
        color: #f8fafc;
        margin-bottom: 6px;
    }

    .step-card p {
        font-size: 13px;
        color: #94a3b8;
        line-height: 1.5;
        margin: 0;
    }

    @media (max-width: 768px) {
        .app-card-main {
            padding: 36px 20px;
            border-radius: 20px;
        }
        .app-hero-title {
            font-size: 26px;
        }
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .steps-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .app-meta-info {
            flex-direction: column;
            gap: 6px;
        }
    }
    @media (max-width: 420px) {
        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="app-hero-section">
    <div class="app-card-main">
        <div class="app-badge-status">
            <i class="fas fa-circle"></i> Versão Oficial 100% Segura
        </div>

        <div class="app-icon-wrapper">
            <i class="fab fa-android"></i>
        </div>

        <h1 class="app-hero-title">Aplicativo {{ $settings->app_name ?? 'FyneCine' }} para Android</h1>
        
        <p class="app-hero-desc">
            Assista a milhares de filmes, séries, canais ao vivo de esportes, canais de filmes e muito mais. Transmita diretamente para sua TV com suporte a Chromecast e streaming de alta velocidade.
        </p>

        <div class="download-action-box">
            @if(!empty($settings->update_url))
                <a href="{{ $settings->update_url }}" class="btn-download-apk" target="_blank" rel="noopener">
                    <i class="fas fa-download"></i> Baixar APK Oficial
                </a>
            @else
                <button class="btn-download-apk" style="background: #1e1e24; color: #64748b; cursor: not-allowed;" disabled>
                    <i class="fas fa-clock"></i> Atualização em Breve
                </button>
            @endif

            <div class="app-meta-info">
                <span><i class="fas fa-check-shield"></i> Verificado & Seguro</span>
                <span><i class="fas fa-microchip"></i> Android 5.0+</span>
                <span><i class="fas fa-cast"></i> Transmissão para TV</span>
            </div>
        </div>

        <!-- Recursos do App -->
        <div class="features-grid">
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-bolt"></i></div>
                <h4>Player Otimizado</h4>
                <p>Carregamento instantâneo com suporte a múltiplos servidores e players rápidos.</p>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-cast"></i></div>
                <h4>Transmita para TV</h4>
                <p>Envie o conteúdo direto para sua Smart TV via Chromecast ou transmissão de tela.</p>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-satellite-dish"></i></div>
                <h4>Canais ao Vivo</h4>
                <p>Assista a canais de TV ao vivo, incluindo canais abertos, esportes e entretenimento.</p>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-futbol"></i></div>
                <h4>Esportes ao Vivo</h4>
                <p>Canais exclusivos de esportes com futebol, UFC, NBA e mais, tudo em tempo real.</p>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-film"></i></div>
                <h4>Canais de Filmes</h4>
                <p>Canais 24h dedicados a filmes de ação, terror, comédia, clássicos e lançamentos.</p>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fas fa-bell"></i></div>
                <h4>Lançamentos Diários</h4>
                <p>Notificações automáticas quando novos episódios e lançamentos forem adicionados.</p>
            </div>
        </div>
    </div>
</div>

<!-- Como Instalar -->
<div class="install-guide-section">
    <h3 class="install-guide-title"><i class="fas fa-info-circle"></i> Como instalar no seu aparelho</h3>
    <div class="steps-grid">
        <div class="step-card">
            <span class="step-number">1</span>
            <h5>Baixe o APK</h5>
            <p>Clique no botão de download acima para baixar o arquivo oficial de instalação.</p>
        </div>
        <div class="step-card">
            <span class="step-number">2</span>
            <h5>Permita Fontes Desconhecidas</h5>
            <p>Se o Android solicitar, permita a instalação de aplicativos externos no navegador.</p>
        </div>
        <div class="step-card">
            <span class="step-number">3</span>
            <h5>Abra e Aproveite</h5>
            <p>Conclua a instalação e abra o aplicativo para desfrutar de todo o catálogo grátis.</p>
        </div>
    </div>
</div>
@endsection
