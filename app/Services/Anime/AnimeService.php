<?php

namespace App\Services\Anime;

use App\Model\Anime;
use Illuminate\Support\Facades\DB;

class AnimeService
{
    public function getAllAnime() {
        return  Anime::all();
    }

    public function store ($data) {
        if ($this->hasAnime($data['slug'])) {
            return false;
        }
        return Anime::insert($data);
    }

    public function hasAnime($slug) {
        return Anime::where('slug', $slug)->first();
    }
}
