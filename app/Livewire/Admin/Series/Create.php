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
        $category_id,
        $genres,
        $is_free = 1,
        $price = 0,
        $status = 'ongoing';

    public $searchGenre = '';
    public $selectedGenres = [];
    public $selecteTag = [];

    #[On('set-coins')]
    public function setCoins($price, $is_free)
    {
        $this->price = $price;
        $this->is_free = $is_free;
    }
    
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
        if (auth()->user()->can('create')) {
            $this->validate([
                'title' => 'string|required|min:3',
                'slug' => 'required',
                'tag' => 'nullable|string',
                'original_title' => 'nullable|string|min:3',
                'gallery_id' => 'required',
                'overview' => 'nullable|string|min:5',
                'status' => 'nullable|string',
                'tag' => 'nullable|string',
                'category_id' => 'required'
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
                'published_day' => Carbon::parse($this->date)->format('l'),
                'tag' => trim($this->tag),
                'category_id' => $this->category_id,
                'price' =>  $this->is_free ? 0 : $this->price,
                'is_free' => $this->is_free
            ]);

            if ($this->selectedGenres) {
                $genreIds = collect($this->selectedGenres)->pluck('id')->toArray();
                $series->genres()->attach($genreIds);
            }

            $this->flash('success', 'Series created successfully', [], route('series'));
        } else {
            $this->alert('error', 'kamu tidak mempunyai izin');
        }
    }

    public function removePoster()
    {
        $this->urlPoster = '';
        $this->gallery_id = '';
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
