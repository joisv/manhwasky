<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'chapter_id'
    ];
    
    public function chapters()
    {
        return $this->belongsTo(Chapter::class);
    }
}
