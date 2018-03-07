<?php

namespace App\Services\Anime;

use App\Model\Anime;
use Illuminate\Support\Facades\DB;

class AnimeService
{
    public function getAllAnime() {
        return  Anime::all();
    }
}
