<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
use App\Models\Genre;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Gera o Sitemap XML completo para o Google e outros buscadores.
     * Possui cache automático de 6 horas para altíssima performance.
     */
    public function index()
    {
        $content = Cache::remember('fynecine_sitemap_xml', 21600, function () {
            $movies = Movie::select('slug', 'updated_at')->latest('updated_at')->get();
            $series = Serie::select('id', 'slug', 'updated_at')->with(['seasons.episodes' => function ($q) {
                $q->select('id', 'season_id', 'episode_number', 'updated_at');
            }])->latest('updated_at')->get();
            $genres = Genre::select('slug', 'updated_at')->get();

            $xml = view('sitemap.index', [
                'movies' => $movies,
                'series' => $series,
                'genres' => $genres,
            ])->render();

            // Salva também o arquivo físico em public/sitemap.xml para Nginx/Apache
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
