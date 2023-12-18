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

    #[Url(as:'sort')]
    public $sortDirection = 'All';
    #[Url(as:'g')]
    public $selectedGenre;

    public function getSeriesWhereGenre()
    {
        if (!empty($this->staticGenre)) {
            $query =  Series::whereHas('genres', fn ($query) => $query->where('name', $this->selectedGenre));

            if (!is_null($this->sortDirection) && $this->sortDirection !== 'All') {
                if (in_array($this->sortDirection, ['Ongoing', 'Pending', 'Finish'])) {
                    $query->where('status', $this->sortDirection)->orderByDesc('views');
                }else{
                    $sort = $this->sortDirection === 'Updated' ? 'updated_at' : $this->sortDirection;
                    $this->series = $query->orderByDesc(strtolower($sort));
                }
            }

            $this->series = $query->get();
        }
    }

    public function setGenre($name)
    {
        $this->selectedGenre = $name;
        $this->getSeriesWhereGenre();
    }

    public function mount($staticGenre, $selectedGenre)
    {
        $this->allGenre = Genre::whereNotIn('id', $staticGenre->pluck('id'))->OrderBy('name', 'desc')->get();
        $this->selectedGenre = $selectedGenre;
        $this->getSeriesWhereGenre();
    }

    public function render()
    {
        return view('livewire.pages.home.genres');
    }
}
