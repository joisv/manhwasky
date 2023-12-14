<?php

namespace App\Livewire\Pages\Home;

use App\Models\Genre;
use Livewire\Component;

class Genres extends Component
{
    public function render()
    {
        $staticGenre = Genre::latest('id')->take(7)->get();
        $allGenresExceptStatic = Genre::whereNotIn('id', $staticGenre->pluck('id'))->get();
        return view('livewire.pages.home.genres', [
            'staticGenre' => $staticGenre,
            'allGenre' => $allGenresExceptStatic
        ]);
    }
}
