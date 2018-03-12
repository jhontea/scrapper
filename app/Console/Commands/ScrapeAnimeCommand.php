<?php

namespace App\Console\Commands;

use App\Mail\AnimeNotif;
use App\Model\Anime;
use App\Services\Anime\AnimeService;
use App\Services\Anime\AnimeScrapeService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;

class ScrapeAnimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:anime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily scrape update anime';

    /**
     * Anime service.
     *
     * @var animeService
     */
    protected $animeService;

    /**
     * Anime scrape service.
     *
     * @var animeScrapeService
     */
    protected $animeScrapeService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AnimeService $animeService, AnimeScrapeService $animeScrapeService)
    {
        parent::__construct();
        $this->animeService = $animeService;
        $this->animeScrapeService = $animeScrapeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get data from scraping daily update
        $datas = $this->animeService->getAllAnime();
        $daily = $this->animeScrapeService->scrapeDailyUpdate();
        $animes = $this->animeScrapeService->checkIntersection($datas, $daily);

        foreach ($animes as $anime) {
            // get manga by slug
            $data = $this->animeService->getSelectedAnime($anime['slug']);
            // check if anime already has a chapter
            if ($data->animeEpisodes->count()) {
                // check if the chapter already on db
                $exist = $this->animeService->checkExistEpisode($anime['slug'], $anime['episode']);
                if ($exist) {
                    // Log::notice('anime already up to date');
                    $this->info($data->title . ' episode ' . $anime['episode'] . ' already up to date');
                } else {
                // store chapter
                    $this->storeEpisode($anime, $data);
                }
            } else {
                // store chapter
                $this->storeEpisode($anime, $data);
            }
        }
    }

    /**
     * Store episode
     *
     * @param array $anime
     * @param object $data
     * @return void
     */
    public function storeEpisode($anime, $data) {
        \App\Model\AnimeEpisode::insert([
            'episode'   => $anime['episode'],
            'anime_id'  => $data->id
        ]);

        $this->sendNotification($anime, $data);

        $this->info($data->title . ' episode ' . $anime['episode'] . ' has been stored');
    }

    public function sendNotification($anime, $data)
    {
        $title = "Anime Scrape Info";
        $when = Carbon::now()->addSecond(5);
        $this->info('send email after 5 second');
        Mail::to('hafizhipb49@gmail.com', 'hafizh')->later($when, new AnimeNotif($anime, $data, $title));
    }
}
