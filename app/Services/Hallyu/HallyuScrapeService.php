<?php

namespace App\Services\Hallyu;

use App\Traits\ScraperTrait;
use Illuminate\Support\Facades\Log;
use Cache;
use Exception;

class HallyuScrapeService
{
    use ScraperTrait;
    
    /**
     * Where to change style if anything changed from the original page
     *
     * @var string
     */


    protected $style = [
        //
    ];

    public function __construct() {
        $this->url = env('HALLYU_URL');
    }

    public function visitUrl($url, $count) {
        for ($i=1; $i<=$count; $i++) {
            $scrape = $this->getScrape($this->url.$url);
        }                
        
        $visit = $scrape->filter('#post-475 > div.td-post-header > header > div > div.td-post-views')->text();

        return $visit;
    }
}
