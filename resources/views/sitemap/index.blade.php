{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Páginas Estáticas e Principais --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('frontend.search') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('frontend.app-download') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('terms') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc>{{ route('privacy') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>

    {{-- Gêneros --}}
    @foreach ($genres as $genre)
        @if ($genre->slug)
        <url>
            <loc>{{ route('frontend.genre', $genre->slug) }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
        @endif
    @endforeach

    {{-- Filmes --}}
    @foreach ($movies as $movie)
        @if ($movie->slug)
        <url>
            <loc>{{ route('frontend.movie', $movie->slug) }}</loc>
            <lastmod>{{ ($movie->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
        @endif
    @endforeach

    {{-- Séries e Episódios --}}
    @foreach ($series as $serie)
        @if ($serie->slug)
        <url>
            <loc>{{ route('frontend.serie', $serie->slug) }}</loc>
            <lastmod>{{ ($serie->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>

        {{-- Episódios da Série --}}
        @foreach ($serie->seasons as $season)
            @foreach ($season->episodes as $episode)
                <url>
                    <loc>{{ route('frontend.episode', ['slug' => $serie->slug, 'season' => $season->season_number, 'episode' => $episode->episode_number]) }}</loc>
                    <lastmod>{{ ($episode->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
                    <changefreq>monthly</changefreq>
                    <priority>0.7</priority>
                </url>
            @endforeach
        @endforeach
        @endif
    @endforeach
</urlset>
