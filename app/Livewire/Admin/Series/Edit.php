<?php

namespace App\Livewire\Admin\Series;

use App\Models\Gallery;
use App\Models\Genre;
use App\Models\Series;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public $series;
    public $title,
        $slug,
        $overview,
        $original_title,
        $setDate = false,
        $tag,
        $date,
        $gallery_id,
        $category_id,
        $urlPoster,
        $price,
        $is_free = 1,
        $status = 'ongoing';

    public $genres;
    public $searchGenre = '';
    public $selectedGenres = [];

    #[On('set-coins')]
    public function setCoins($price, $is_free)
    {
        $this->price = $price;
        $this->is_free = $is_free;
    }
    
    #[On('select-poster')]
    public function setSelectedposted($id, $url)
    {
        $this->gallery_id = $id;
        $this->urlPoster = $url;
    }

    #[On('setSelectedCategory')]
    public function evtSelectedSeries($value)
    {
        if (empty($value)) {
            $this->category_id = '';
        } else {
            $this->category_id = $value;
        }
    }
    
    #[On('setslug')]
    public function setSlugAttribute()
    {
        $slug = Str::slug($this->title);
        $originalSlug = $slug;
        $count = 2;

        while (Series::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $this->slug = $slug;
    }

    public function removePoster()
    {
        $this->urlPoster = '';
        $this->gallery_id = '';
    }

    public function save()
    {
        if (auth()->user()->can('update')) {
            $this->validate([
                'title' => 'string|required|min:3',
                'slug' => 'required',
                'tag' => 'nullable|string',
                'original_title' => 'nullable|string|min:3',
                'gallery_id' => 'required',
                'overview' => 'nullable|string|min:5',
                'status' => 'nullable|string',
                'category_id' => 'required'
            ]);
    
            $this->series->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'tag' => $this->tag,
                'original_title' => $this->original_title,
                'gallery_id' => $this->gallery_id,
                'overview' => $this->overview,
                'status' => $this->status,
                'created' => $this->date,
                'published_day' => Carbon::parse($this->date)->format('l'),
                'category_id' => $this->category_id,
                'price' => $this->is_free ? 0 : $this->price,
                'is_free' => $this->is_free
            ]);
    
            if ($this->selectedGenres) {
                $genreIds = collect($this->selectedGenres)->pluck('id')->toArray();
                $this->series->genres()->sync($genreIds);
            }
            $this->alert('success', 'Series created successfully');
            $this->redirectRoute('series');
        }else{
            $this->alert('error', 'kamu tidak memiliki izin untuk update');
        }
    }

    public function mount()
    {
        $this->title = $this->series->title;
        $this->slug = $this->series->slug;
        $this->overview = $this->series->overview;
        $this->original_title = $this->series->original_title;
        $this->tag = $this->series->tag;
        $this->date = $this->series->created;
        $this->gallery_id = $this->series->gallery_id;
        $this->category_id = $this->series->category_id;
        $this->urlPoster = Gallery::where('id', $this->series->gallery_id)->select('image')->first()?->image;
        $this->status = $this->series->status;
        $this->price = $this->series->price;
        $this->is_free = $this->series->is_free;
        $this->getGenre();
    }

    public function getGenre($value = '')
    {
        $this->genres = Genre::search('name', $value)->latest('id')->get();
        $genreData = $this->series->genres()->get();

        if (is_iterable($genreData)) {
            foreach ($genreData as $genre) {
                $this->selectedGenres[] = ['id' => $genre->id, 'name' => $genre->name];
            }

            $this->genres = $this->genres->diff($genreData);
        }
    }


    public function restoreGenre($id)
    {
        $restoredGenre = Genre::find($id);
        if ($restoredGenre) {
            if (!$this->genres) {
                $this->genres = collect();
            }
            $this->genres->push($restoredGenre);
            $this->selectedGenres = collect($this->selectedGenres)->reject(function ($genre) use ($id) {
                return $genre['id'] == $id;
            })->toArray();
        }
    }

    public function removeGenre($id)
    {
        // Menghapus genre dengan ID tertentu dari $this->genres
        $this->genres = $this->genres->reject(function ($genre) use ($id) {
            return $genre->id == $id;
        });
    }

    public function setSelectedGenre($id, $name)
    {
        $this->removeGenre($id);
        $this->selectedGenres[] = ['id' => $id, 'name' => $name];
    }

    public function updatedSearchGenre($props)
    {
        $this->getGenre($props);
    }

    public function render()
    {
        return view('livewire.admin.series.edit');
    }
}
