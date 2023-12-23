<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Series extends Model
{
    use HasFactory, HasSEO;

    protected $fillable = [
        'title',
        'price',
        'is_free',
        'slug',
        'tag',
        'published_day',
        'original_title',
        'gallery_id',
        'category_id',
        'overview',
        'status',
        'created',
    ];

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: "Baca $this->title",
            description: $this->overview,
            robots: 'follow, index',
            image: "storage/" . $this->gallery->image ?? '',
            schema: SchemaCollection::initialize()->addArticle(),
            tags: $this->tag ? explode(', ', $this->tag) : []
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_series')->withTimestamps();
    }

    public function purchasedByUsers()
    {
        $this->belongsToMany(User::class, 'purchase_series', 'series_id', 'user_id');    
    }
    
}
