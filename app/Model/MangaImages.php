<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MangaImages extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'manga_chapter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manga_id', 
        'chapter',
        'image'
    ];

    public function manga()
    {
        return $this->belongsTo(Manga::class, 'manga_id');
    }
}
