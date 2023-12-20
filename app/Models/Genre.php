<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'primary_color'
    ];
    
    public function series()
    {
        return $this->belongsToMany(Series::class, 'series_genre', 'genre_id', 'series_id');
    }
}
