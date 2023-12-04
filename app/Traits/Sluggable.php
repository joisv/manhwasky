<?
namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    abstract protected function sluggableColumn();

    public function setSlugAttribute()
    {
        $slug = Str::slug($this->{$this->sluggableColumn()});
        $originalSlug = $slug;
        $count = 2;

        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $this->attributes['slug'] = $slug;
    }

    protected function slugExists($slug)
    {
        return static::where('slug', $slug)->exists();
    }
    
}