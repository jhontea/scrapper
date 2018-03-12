<?php

namespace App\Http\Controllers\Promo;

use App\Http\Controllers\Controller;
use App\Services\Promo\PromoService;
use App\Services\Promo\PromoScrapeService;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index() {
        $promoService = new PromoService();

        $datas = $promoService->getAllPromo();
        return view('promo.index', compact('datas'));
    }

    public function show($slug) {
        $promoService = new PromoService();
        $promoScrapeService = new PromoScrapeService();

        $store = $promoService->getStoreBySlug($slug);
        $datas = $promoScrapeService->switchSlug($slug);

        if ($datas) {
            return view('promo.show', compact('datas', 'store'));
        }

        abort(404);
    }
}
