<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait ScraperTrait
{
    /*
    |--------------------------------------------------------------------------
    | Scaper Trait
    |--------------------------------------------------------------------------
    |
    | This controller handle data from front-end style website. If error happen,
    | check the style from website if anything changed from the original page.
    |
    */

    /**
     * Scrape data
     * 
     * @param string $url url where website scrape
     */
    public function getScrape($url) {
        try {
            $scraper = \Goutte::request('GET', $url);
            return $scraper;
        } catch (Exception $err) {
            Log::error("[SCRAPE-TRAIT][GET-SCRAPE][{$url}] {$err->getMessage()}");
            return redirect()->back();
        }
    }
}