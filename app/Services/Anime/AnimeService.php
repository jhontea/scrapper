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

    public function getSelectedAnime($slug) {
        return Anime::where('slug', $slug)
                ->with('animeEpisodes')
                ->first();
    }

    public function checkExistEpisode($slug, $episode) {
        return $data = DB::table('anime as a')
                ->join('anime_episodes as ae', 'ae.anime_id', '=', 'a.id')
                ->where('ae.episode', $episode)
                ->where('a.slug', $slug)
                ->first();
    }
}
