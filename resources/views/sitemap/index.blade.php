{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Páginas Estáticas e Principais --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ date('Y-m-d\TH:i:s\Z') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/busca') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/baixar-app') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/terms') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc>{{ url('/privacy') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>

    {{-- Gêneros --}}
    @foreach ($genres as $genre)
        @if (!empty($genre->slug))
        <url>
            <loc>{{ url('/genero/' . $genre->slug) }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
        @endif
    @endforeach

    {{-- Filmes --}}
    @foreach ($movies as $movie)
        @if (!empty($movie->slug))
        <url>
            <loc>{{ url('/filme/' . $movie->slug) }}</loc>
            <lastmod>{{ !empty($movie->updated_at) ? date('Y-m-d\TH:i:s\Z', strtotime($movie->updated_at)) : date('Y-m-d\TH:i:s\Z') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
        @endif
    @endforeach

    {{-- Séries --}}
    @foreach ($series as $serie)
        @if (!empty($serie->slug))
        <url>
            <loc>{{ url('/serie/' . $serie->slug) }}</loc>
            <lastmod>{{ !empty($serie->updated_at) ? date('Y-m-d\TH:i:s\Z', strtotime($serie->updated_at)) : date('Y-m-d\TH:i:s\Z') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
        @endif
    @endforeach

    {{-- Episódios --}}
    @if(isset($episodes))
        @foreach ($episodes as $ep)
        <url>
            <loc>{{ url('/serie/' . $ep->serie_slug . '/temporada/' . $ep->season_number . '/episodio/' . $ep->episode_number) }}</loc>
            <lastmod>{{ !empty($ep->updated_at) ? date('Y-m-d\TH:i:s\Z', strtotime($ep->updated_at)) : date('Y-m-d\TH:i:s\Z') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
        @endforeach
    @endif
</urlset>
