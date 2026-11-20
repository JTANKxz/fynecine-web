<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\Genre;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera o arquivo físico sitemap.xml na pasta public para o Google';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Consultando filmes, séries e episódios...');

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

        $destination = public_path('sitemap.xml');
        file_put_contents($destination, $xml);

        $this->info("Sitemap gerado com sucesso em: {$destination}");
        $this->info("Total: {$movies->count()} filmes, {$series->count()} séries.");

        return Command::SUCCESS;
    }
}
