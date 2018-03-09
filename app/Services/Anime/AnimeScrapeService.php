<?php

namespace App\Services\Anime;

use App\Services\Anime\AnimeService;
use App\Traits\ScraperTrait;
use Illuminate\Support\Facades\Log;
use Cache;
use Exception;

class AnimeScrapeService
{
    use ScraperTrait;
    
    /**
     * Where to change style if anything changed from the original page
     *
     * @var string
     */


    protected $style = [
        'anime' => [
            'daily' => '#main-content > div.content > div.post-listing.archive-box > article'
        ]
    ];

    public function __construct() {
        $this->url = env('ANIME_URL');
    }

    // Get daily update anime
    public function scrapeDailyUpdate() {
        $result = Cache::remember('anime-daily', 2*60, function() {
            for ($i=1; $i<=2; $i++) {
                $scrape = $this->getScrape($this->url.'page/'.$i);
                $daily[] = $scrape->filter($this->style['anime']['daily'])->each(function ($node) {
                    $boxTitle = explode("Episode", $node->filter('h2 > a')->text());
                    $episode = explode(' ', trim($boxTitle[1]));
                    $url = $node->filter('h2 > a')->attr('href');
                    $slug = explode($this->url, $url);
                    return [
                        'title'     => trim($boxTitle[0]),
                        'episode'   => $episode[0],
                        'img'       => $node->filter('div.post-thumbnail > a > img')->attr('src'),
                        'url'       => $url,
                        'slug'      => $slug[1]
                    ];
                });
            }

            return $daily;
        });

        return $result;
    }

    //check intersect with database
    public function checkIntersection($models, $dataScrape) {
        $result = [];

        foreach ($dataScrape as $data) {
            foreach ($models as $model) {
                if ($data['slug'] == $model['slug']) {
                    $result[] = $data;
                }
            }
        }

        return $result;
    }
}
