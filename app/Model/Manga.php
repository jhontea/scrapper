<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mangas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'slug',
        'image',
        'status',
        'author',
        'release',
        'category',
        'rating'
    ];

    public $timestamps = true;

    public function mangaImages()
    {
        return $this->hasMany(MangaImages::class, 'manga_id');
    }

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::forget('all_manga');
        });
    }
}
