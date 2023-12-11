<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'tag',
        'published_day',
        'original_title',
        'gallery_id',
        'overview',
        'status',
        'created',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'series_genre', 'series_id', 'genre_id');
    }
    
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
