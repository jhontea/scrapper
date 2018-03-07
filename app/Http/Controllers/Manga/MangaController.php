<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\Controller;
use App\Services\Manga\MangaService;
use App\Services\Manga\MangaScrapeService;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    /**
     * Home view
     * Show daily scrape data
     *
     * @return view
     */
    public function index() {
        $mangaService = new MangaService();
        $mangaScrapeService = new MangaScrapeService();

        $datas = $mangaService->getAllManga();
        $daily = $mangaScrapeService->scrapeDailyUpdate($datas);
        $daily = $mangaScrapeService->checkIntersection($datas, $daily);

        return view('manga.index', compact('daily'));
    }

    // Get latest manga scrape 
    public function addManga() {
        $mangaScrapeService = new MangaScrapeService();
        $scrape = $mangaScrapeService->getLatestRelease();

        return view('manga.add-manga', compact('scrape'));
    }

    // Save manga scrape
    public function saveManga() {
        $mangaScrapeService = new MangaScrapeService();
        $scrape = $mangaScrapeService->storeManga();

        return redirect()->back();
    }

    // Manga list from database
    public function myManga() {
        $mangaService = new MangaService();
        $datas = $mangaService->getAllManga();

        return view('manga.my-manga', compact('datas'));
    }

    // Show manga detail and chapters
    public function show($slug) {
        $mangaService = new MangaService();
        $data = $mangaService->getSelectedManga($slug);
        $chapters = $mangaService->getMangaChapter($slug);
        $breadcrumbs = [
            [
                'url'   => route('manga.my'),
                'name'  => 'My manga'
            ], [
                'name'  => $data->title
            ]
        ];
        return view('manga.show', compact('data', 'chapters', 'breadcrumbs'));
    }

    public function read($slug, $chapter) {
        $mangaService = new MangaService();
        $data = $mangaService->getSelectedManga($slug);
        $breadcrumbs = [
            [
                'url'   => route('manga.my'),
                'name'  => 'My manga'
            ], [
                'url'   => route('manga.show', ['slug' => $slug]),
                'name'  => $data->title
            ], [
                'name'  => 'Chapter ' . $chapter
            ]
        ];
        return view('manga.read', compact('data', 'breadcrumbs'));
    }
}
