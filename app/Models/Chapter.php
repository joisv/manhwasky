<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'created',
        'slug',
        'published_day',
        'title',
        'views',
        'series_id'
    ];
    
    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function contents()
    {
        return $this->hasMany(ChapterContent::class);
    }
}
