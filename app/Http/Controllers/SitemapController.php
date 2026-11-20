<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
use App\Models\Episode;
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

            return view('sitemap.index', [
                'movies' => $movies,
                'series' => $series,
                'genres' => $genres,
            ])->render();
        });

        return response($content, 200)
            ->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
