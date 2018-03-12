<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'slug',
        'image',
        'url',
        'type',
    ];
}
