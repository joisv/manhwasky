<?php

namespace App\Livewire\Pages\Home;

use App\Models\Genre;
use App\Models\Series;
use Livewire\Attributes\Url;
use Livewire\Component;

class Genres extends Component
{
    public $staticGenre;
    public $allGenre;
    public $series;
    #[Url]
    public $genreActive;

    public function getSeriesWhereGenre()
    {
        if (!empty($this->staticGenre)) {
            $this->series =  Series::whereHas('genres', function ($query) {
                $query->where('name', $this->genreActive);
            })->get();
        }
    }

    public function setGenre($name)
    {
        $this->genreActive = $name;
        $this->getSeriesWhereGenre();
    }

    public function mount($staticGenre, $genreActive)
    {
        $this->allGenre = Genre::whereNotIn('id', $staticGenre->pluck('id'))->OrderBy('name', 'desc')->get();
        $this->genreActive = $genreActive;
        $this->getSeriesWhereGenre();
    }

    public function render()
    {
        return view('livewire.pages.home.genres');
    }
}
