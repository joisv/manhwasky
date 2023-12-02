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
        'original_title',
        'gallery_id',
        'overview',
        'status',
        'created',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
