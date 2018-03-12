<?php

namespace App\Services\Promo;

use App\Services\Promo\PromoService;
use App\Traits\ScraperTrait;
use Illuminate\Support\Facades\Log;
use Cache;
use Exception;

class PromoScrapeService
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
        $this->vipUrl = 'https://www.vipplaza.co.id/index.php/flashsale';
    }

    public function switchSlug($slug) {
        $data = '';

        if ($slug == 'vip-plaza') {
            $data = $this->getVipBanner();
        }

        return $data;
    }

    public function getVipBanner() {
        $scrape = $this->getScrape($this->vipUrl);

        return $scrape->filter('#divevent > div > div > div:nth-child(3) > div')->each(function ($node) {
            return $node->filter('div > img')->attr('src');
        });
    }
}
