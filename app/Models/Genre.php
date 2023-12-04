<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Series::class, 'series_genre', 'genre_id', 'series_id');
    }
}
