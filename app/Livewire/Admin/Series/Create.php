<?php

namespace App\Livewire\Admin\Series;

use App\Models\Genre;
use App\Models\Series;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class Create extends Component
{
    use LivewireAlert;

    public $title,
        $slug,
        $overview,
        $original_title,
        $setDate = false,
        $tag,
        $date,
        $gallery_id,
        $urlPoster,
        $genres,
        $status = 'ongoing';

    public $searchGenre = '';
    public $selectedGenres = [];
    public $selecteTag = [];

    public function mount()
    {
        $this->date = Carbon::now();
        $this->getGenre();
    }

    public function render()
    {
        return view('livewire.admin.series.create');
    }

    public function save()
    {
        $this->validate([
            'title' => 'string|required|min:3',
            'slug' => 'required',
            'tag' => 'nullable|string',
            'original_title' => 'nullable|string|min:3',
            'gallery_id' => 'required',
            'overview' => 'nullable|string|min:5',
            'status' => 'nullable|string',
        ]);

       $series = Series::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'tag' => $this->tag,
            'original_title' => $this->original_title,
            'gallery_id' => $this->gallery_id,
            'overview' => $this->overview,
            'status' => $this->status,
            'created' => $this->date,
        ]);

        if ($this->selectedGenres) {
            $genreIds = collect($this->selectedGenres)->pluck('id')->toArray();
            $series->genres()->attach($genreIds);
        }
        
        $this->flash('success', 'Series created successfully', [], route('series'));
    }

    public function removePoster()
    {
        $this->urlPoster = '';
        $this->gallery_id = '';
    }

    #[On('select-poster')]
    public function setSelectedposted($id, $url)
    {
        $this->gallery_id = $id;
        $this->urlPoster = $url;
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

    // genre
    public function getGenre($value = '')
    {
        $this->genres = Genre::search('name', $value)->latest('id')->get();
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
    // endgenre
}
