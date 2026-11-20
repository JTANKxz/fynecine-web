<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Gera o arquivo físico sitemap.xml na pasta public para o Google';

    public function handle(): int
    {
        $this->info('Consultando catálogo de filmes e séries...');

        $movies = DB::table('movies')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->select('slug', 'updated_at')
            ->orderByDesc('updated_at')
            ->get();

        $series = DB::table('series')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->select('slug', 'updated_at')
            ->orderByDesc('updated_at')
            ->get();

        $genres = DB::table('genres')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->select('slug', 'updated_at')
            ->get();

        $episodes = DB::table('episodes')
            ->join('seasons', 'episodes.season_id', '=', 'seasons.id')
            ->join('series', 'seasons.series_id', '=', 'series.id')
            ->whereNotNull('series.slug')
            ->where('series.slug', '!=', '')
            ->whereNotNull('seasons.season_number')
            ->whereNotNull('episodes.episode_number')
            ->select(
                'series.slug as serie_slug',
                'seasons.season_number',
                'episodes.episode_number',
                'episodes.updated_at'
            )
            ->limit(5000)
            ->get();

        $xml = view('sitemap.index', [
            'movies'   => $movies,
            'series'   => $series,
            'genres'   => $genres,
            'episodes' => $episodes,
        ])->render();

        $destination = public_path('sitemap.xml');
        file_put_contents($destination, $xml);

        $this->info("Sitemap gerado com sucesso em: {$destination}");
        $this->info("Total: {$movies->count()} filmes, {$series->count()} séries, {$episodes->count()} episódios.");

        return Command::SUCCESS;
    }
}
