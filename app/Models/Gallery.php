<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];
    
    public function chapters()
    {
        return $this->belongsToMany(Series::class, 'chapter_gallery', 'chapter_id', 'gallery_id');
    }

    public function series()
    {
        return $this->hasMany(Series::class);
    }
}
