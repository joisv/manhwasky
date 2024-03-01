<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Attributes\On;
use Livewire\Component;

class Recommend extends Component
{
    public $series;
    public $recommend;
    public $genres = [];

    public function mount()
    {
        $this->genres = $this->series->genres->map(function ($genre) {
            return $genre->name;
        });
    }

    #[On('get-recommend')]
    public function getRecommend()
    {
        $genres = $this->genres;

        $this->recommend = Series::where(function ($query) use ($genres) {
            foreach ($genres as $genre) {
                $query->orWhereHas('genres', function ($q) use ($genre) {
                    $q->where('name', $genre);
                });
            }
        })
        ->whereNotIn('id', [$this->series->id])
            ->take(9)
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.home.recommend');
    }
}
