<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnimeEpisode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime_episodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'anime_id', 
        'episode'
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class, 'anime_id');
    }
}
