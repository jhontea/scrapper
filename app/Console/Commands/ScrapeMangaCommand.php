<?php

namespace App\Console\Commands;

use App\Mail\MangaNotif;
use App\Model\Manga;
use App\Services\Manga\MangaService;
use App\Services\Manga\MangaScrapeService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;

class ScrapeMangaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:manga';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily scrape update manga';

    /**
     * Manga service.
     *
     * @var mangaService
     */
    protected $mangaService;

    /**
     * Manga scrape service.
     *
     * @var mangaScrapeService
     */
    protected $mangaScrapeService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MangaService $mangaService, MangaScrapeService $mangaScrapeService)
    {
        parent::__construct();
        $this->mangaService = $mangaService;
        $this->mangaScrapeService = $mangaScrapeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get data from scraping daily update
        $datas = $this->mangaService->getAllManga();
        $daily = $this->mangaScrapeService->scrapeDailyUpdate($datas);
        $mangas = $this->mangaScrapeService->checkIntersection($datas, $daily);

        foreach ($mangas as $manga) {
            // get manga by slug
            $data = $this->mangaService->getSelectedManga($manga['slug']);
            // check if manga already has a chapter
            if ($data->mangaImages->count()) {
                // check if the chapter already on db
                $exist = $this->mangaService->checkExistChapter($manga['slug'], $manga['chapter']);
                if ($exist) {
                //Log::notice('Manga already up to date');
                    $this->info($data->title . ' chapter ' . $manga['chapter'] . ' already up to date');
                } else {
                // store chapter
                    $this->storeChapter($manga, $data);
                }
            } else {
                // store chapter
                $this->storeChapter($manga, $data);
            }
        }
    }

    /**
     * Store chapter by scraping image
     *
     * @param array $manga
     * @param object $data
     * @return void
     */
    public function storeChapter($manga, $data) {
        $scrape = $this->mangaScrapeService->scrapeChapter($manga['slug'], $manga['chapter'], $data->id);
        if ($scrape['result']) {
            \App\Model\MangaImages::insert($scrape['result']);
            $this->info($data->title . ' chapter ' . $manga['chapter'] . ' has been stored');
            $this->sendNotification($manga, $data);
        }
    }

    public function sendNotification($manga, $data)
    {
        $title = "Manga Scrape Info";
        $when = Carbon::now()->addSecond(5);
        $this->info('send email after 5 second');
        Mail::to('hafizhipb49@gmail.com', 'hafizh')->later($when, new MangaNotif($manga, $data, $title));
    }
}
