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

    public function save() {
        try {
            $animeService = new AnimeService();

            $response = [
                'status'  => 2,
                'message' => request()->get('title') . ' has already on DB',
                'alert'   => 'info',
                'info'    => 'Duplicate!',
                'result'  => 1,
            ];

            if ($animeService->store(request()->except('_token'))) {
                $response = [
                    'status'  => 1,
                    'message' => 'Save ' . request()->get('title') . ' to DB',
                    'alert'   => 'success',
                    'info'    => 'Success!',
                    'result'  => 1,
                ];
            } 

            return response()->json($response, 200);
        } catch (\Exception $err) {
            $response = [
                'status'  => 0,
                'message' => $err->getMessage(),
                'alert'   => 'error',
                'info'    => 'Failed!',
                'result'  => [],
            ];

            return response()->json($response, 500);
        }
        
    }
}
