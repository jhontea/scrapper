<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'slug',
        'image',
    ];
}
