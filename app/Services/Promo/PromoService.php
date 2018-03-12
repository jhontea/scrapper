<?php

namespace App\Services\Promo;

use App\Model\Promo;
use Illuminate\Support\Facades\DB;

class PromoService
{
    public function getAllPromo() {
        return  Promo::all();
    }

    public function getStoreBySlug($slug) {
        return Promo::where('slug', $slug)->first();
    }
}
