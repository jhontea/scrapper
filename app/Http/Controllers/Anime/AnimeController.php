<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Services\Anime\AnimeService;
use App\Services\Anime\AnimeScrapeService;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function index() {
        $animeService = new AnimeService();
        $animeScrapeService = new AnimeScrapeService();

        $data = $animeService->getAllAnime();
        $dataScrappers = $animeScrapeService->scrapeDailyUpdate();

        return view('anime.index', compact('dataScrappers'));
    }
}
