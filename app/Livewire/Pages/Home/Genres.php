<?php

namespace App\Livewire\Pages\Home;

use App\Models\Genre;
use App\Models\Series;
use Livewire\Attributes\On;
use Livewire\Component;

class Genres extends Component
{
    public $staticGenre;
    public $allGenre;
    public $series;
    public $genreActive;

    public function getSeriesWhereGenre()
    {
        if (!empty($this->staticGenre)) {
            $this->series =  Series::whereHas('genres', function ($query) {
                $query->where('name', $this->genreActive);
            })->get();
        }
    }

    // #[On('genre-active')]
    // public function setGenreActive($name)
    // {
    //     $this->genreActive = $name;
    //     $this->getSeriesWhereGenre();    
    // }

    public function setGenre($name)
    {
        $this->genreActive = $name;
        $this->getSeriesWhereGenre();
    }

    public function mount()
    {
        $this->staticGenre = Genre::withCount('series')
            ->orderByDesc('series_count')
            ->take(10)
            ->get();
        $this->allGenre = Genre::whereNotIn('id', $this->staticGenre->pluck('id'))->OrderBy('name', 'desc')->get();
        $this->genreActive = $this->staticGenre[0]->name;
        $this->getSeriesWhereGenre();
    }

    public function render()
    {
        return view('livewire.pages.home.genres');
    }
}
