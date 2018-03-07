<?php

namespace App\Services\Manga;

use App\Services\Manga\MangaService;
use App\Traits\ScraperTrait;
use Illuminate\Support\Facades\Log;
use Cache;
use Exception;

class MangaScrapeService
{
    use ScraperTrait;
    
    /**
     * Where to change style if anything changed from the original page
     *
     * @var string
     */


    protected $style = [
        'manga' => [
            'update'    => 'body > div.container-fluid.scroll-here > div:nth-child(3) > div.col-md-12 > div:nth-child(1) > div > div > div',
            'latest'    => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div.mangalist > div',
            'detail'    => [
                'title'         => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > h2',
                'image'         => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-4 > div > img',
                'status'        => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(6) > span',
                'author'        => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(10) > a',
                'author-2'      => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(8) > a',
                'release'       => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(14)',
                'release-2'     => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(12)',
                'category'      => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(16) > a',
                'category-2'    => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(14) > a',
                'rating'        => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(21) > div > div:nth-child(2) > span > meta:nth-child(1)',
                'rating-2'      => 'body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd:nth-child(19) > div > div:nth-child(2) > span > meta:nth-child(1)'
            ],
            'image-all' => 'body > div.container-fluid.scroll-here > div.viewer-cnt > div > div.col-xs-12.col-sm-12 > div > img'
        ]
    ];

    public function __construct() {
        $this->url = env('MANGA_URL').'manga';
    }

    // Get daily update manga
    public function scrapeDailyUpdate() {
        $result = Cache::remember('manga-daily', 3*60, function() {
            $scrape = $this->getScrape(env('MANGA_URL'));
            $daily = $scrape->filter($this->style['manga']['update'])->each(function ($node) {
                preg_match_all('/([\d]+)/', $node->filter('div > div.well > p')->text(), $matchChapter);
                $slug = explode("https://www.komikgue.com/manga/", $node->filter('div > div > a')->attr('href'));
                return [
                    'title'     => $node->filter('div > div.manga-name > a')->text(),
                    'chapter'   => $matchChapter[0][0],
                    'img'       => $node->filter('div > a.thumbnail > img')->attr('src'),
                    'slug'      => $slug[1],
                ];
            });

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

    // Get latest release manga
    public function getLatestRelease() {
        $result = Cache::remember('manga-latest', 3*60, function() {
            $scrape = $this->getScrape(env('MANGA_URL').'latest-release');
            $datas = $scrape->filter($this->style['manga']['latest'])->each(function ($node) {
                preg_match_all('/([\d]+)/', $node->filter('div > div> h6 > a')->text(), $chapter);
                $slug = explode("https://www.komikgue.com/manga/", $node->filter('div > h3 > a')->attr('href'));
                return [
                    'title'     => $node->filter('div > h3 > a')->text(),
                    'slug'      => $slug[1],
                    'chapter'   => $chapter[0][0],
                    'release'   => trim($node->filter('div > small')->text())
                ];           
            });
            
            return $datas;
        });

        return $result;
    }

    // Get detail manga from slug
    public function storeManga() {
        $slug = request()->get('mangaSlug');
        $mangaService = new MangaService();

        // // check if db has already store
        if ($mangaService->hasManga($slug)) {
            \Session::flash('status', 'warning');
            \Session::flash('message', 'You already have this manga');

            return [
                'status'    => 'warning',
                'message'   => 'You already have this manga',
                'result'    => ''
            ];        
        }

        $scrape = $this->getScrape($this->url.'/'.$slug);

        $title = $scrape->filter($this->style['manga']['detail']['title'])->text();
        $image = $scrape->filter($this->style['manga']['detail']['image'])->attr('src');
        $status = $scrape->filter($this->style['manga']['detail']['status'])->text();

        if ($scrape->filter('body > div.container-fluid.scroll-here > div:nth-child(2) > div > div:nth-child(5) > div.col-sm-8 > dl > dd')->count() == 10) {
            $author = $scrape->filter($this->style['manga']['detail']['author'])->text();
            $release = $scrape->filter($this->style['manga']['detail']['release'])->text();
            $rating = $scrape->filter($this->style['manga']['detail']['rating'])->attr('content');
            $category = $scrape->filter($this->style['manga']['detail']['category'])->each(function ($node) {
                return $node->text();
            });
        } else {
            $author = $scrape->filter($this->style['manga']['detail']['author-2'])->text();
            $release = $scrape->filter($this->style['manga']['detail']['release-2'])->text();
            $rating = $scrape->filter($this->style['manga']['detail']['rating-2'])->attr('content');
            $category = $scrape->filter($this->style['manga']['detail']['category-2'])->each(function ($node) {
                return $node->text();
            });
        }

        $filename = basename($image);
        $path = public_path().'/img/manga/'. $slug . '/';
        \File::makeDirectory($path, 0775, true);
        \Image::make($image)->save($path . $filename);

        $store = [
            'title'     => $title,
            'slug'      => $slug,
            'image'     => 'img/manga/'. $slug . '/' . $filename,
            'status'    => $status,
            'author'    => $author,
            'release'   => $release,
            'rating'    => $rating,
            'category'  => join(", ", $category)
        ];
        
        try {
            \Session::flash('status', 'success');
            \Session::flash('message', 'Succes store manga');

            return [ 
                'status'    => 'succes',
                'code'      => 200,
                'result'    => $mangaService->storeScrape($store)
            ];
        } catch (Exception $err) {
            \Session::flash('status', 'danger');
            \Session::flash('message', $err->getMessage());

            Log::error("[Crawler][MANGA-SCRAPE-SERVICE][STORE-MANGA] {$err->getMessage()}");

            return [
                'status'    => 'error',
                'message'   => $err->getMessage(),
                'result'    => ''
            ];
        }
    }

    // scrape chapter by slug
    public function scrapeChapter($slug, $chapter, $mangaId) {
        $scrape = $this->getScrape($this->url.'/'.$slug.'/'.$chapter);
        try {
            // create directory to store image
            $path = public_path().'/img/manga/'. $slug . '/chapters/' . $chapter . '/';
            if (!is_dir($path)) {
                \File::makeDirectory($path, 0775, true);
            }

            $result = $scrape->filter($this->style['manga']['image-all'])->each(function ($node) use($chapter, $mangaId, $path, $slug) {
                $image = trim($node->attr('data-src'));
                $filename = basename($image);
                // save image
                if (!file_exists($path . $filename)) {
                    \Image::make($image)->save($path . $filename);
                }

                return [
                    'manga_id'  => $mangaId,
                    'chapter'   => $chapter,
                    'image'     => 'img/manga/'. $slug . '/chapters/' . $chapter . '/' . $filename
                ];
            });

            return [ 
                'status'    => 'succes',
                'code'      => 200,
                'result'    => $result
            ];
        } catch (Exception $err) {
            Log::error("[Crawler][MANGA-SCRAPE-SERVICE][SCRAPE-SERVICE] {$err->getMessage()}");

            return [
                'status'    => 'error',
                'message'   => $err->getMessage(),
                'result'    => ''
            ];
        }
    }
}
