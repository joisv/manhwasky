<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'main',
        'background',
        'series_id'
    ];

    public function series()
    {
        return $this->belongsTo(Series::class);    
    }
}
