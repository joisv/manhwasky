<?php

namespace App\Models;

use App\Settings\GeneralSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Chapter extends Model
{
    use HasFactory, HasSEO;

    protected $fillable = [
        'created',
        'slug',
        'published_day',
        'title',
        'views',
        'series_id',
        'thumbnail'
    ];
    
    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->series->title." - $this->title",
            description: $this->series->overview,
            robots: 'follow, index',
            image: "storage/".$this->series->gallery->image ?? '',
            schema: SchemaCollection::initialize()->addArticle(),
            tags: $this->series->tag
        );
    }
    
    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function contents()
    {
        return $this->hasMany(ChapterContent::class);
    }
}
