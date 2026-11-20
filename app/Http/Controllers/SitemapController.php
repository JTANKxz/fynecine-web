<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Gera o Sitemap XML completo para o Google e outros buscadores.
     * Utiliza consultas leves e cache de 6 horas para altíssima performance.
     */
    public function index()
    {
        $content = Cache::remember('fynecine_sitemap_xml', 21600, function () {
            // Filmes
            $movies = DB::table('movies')
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->select('slug', 'updated_at')
                ->orderByDesc('updated_at')
                ->get();

            // Séries
            $series = DB::table('series')
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->select('slug', 'updated_at')
                ->orderByDesc('updated_at')
                ->get();

            // Gêneros
            $genres = DB::table('genres')
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->select('slug', 'updated_at')
                ->get();

            // Episódios (Query direta e leve com proteção contra nulos)
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

            // Salva também o arquivo físico em public/sitemap.xml
            try {
                file_put_contents(public_path('sitemap.xml'), $xml);
            } catch (\Throwable $e) {
                // Silencioso se não houver permissão de escrita
            }

            return $xml;
        });

        return response($content, 200)
            ->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
