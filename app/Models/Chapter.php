<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];
    
    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function galleries()
    {
        return $this->belongsToMany(Gallery::class, 'chapter_gallery', 'chapter_id', 'gallery_id');
    }
}
