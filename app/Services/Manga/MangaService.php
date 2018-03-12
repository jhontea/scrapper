<?php

namespace App\Services\Manga;

use App\Model\Manga;
use Illuminate\Support\Facades\DB;

class MangaService
{
    public function getAllManga() {
        return  Manga::all();
    }

    public function getSelectedManga($slug) {
        return Manga::where('slug', $slug)
                ->with('mangaImages')
                ->first();
    }

    public function getReadChapter($slug, $chapter) {
        return $data = DB::table('mangas as m')
                ->join('manga_chapter as mc', 'mc.manga_id', '=', 'm.id')
                ->where('m.slug', $slug)
                ->where('mc.chapter', $chapter)
                ->get();
    }

    public function getMangaChapter($slug) {
        return $data = DB::table('mangas as m')
                ->select('mc.chapter', DB::raw('COUNT(mc.chapter) as total'))
                ->join('manga_chapter as mc', 'mc.manga_id', '=', 'm.id')
                ->where('m.slug', $slug)
                ->groupBy('mc.chapter')
                ->orderBy('mc.chapter', 'desc')
                ->get();
    }

    public function hasManga($slug) {
        return Manga::where('slug', $slug)->first();
    }

    public function storeScrape($data) {
        return Manga::insert($data);
    }

    public function checkExistChapter($slug, $chapter) {
        $data = DB::table('mangas as m')
                ->select('mc.chapter', DB::raw('COUNT(mc.chapter) as total'))
                ->join('manga_chapter as mc', 'mc.manga_id', '=', 'm.id')
                ->where('m.slug', $slug)
                ->groupBy('mc.chapter')
                ->orderBy('mc.chapter', 'desc')
                ->first();

        return $data->chapter == $chapter;
    }
}
