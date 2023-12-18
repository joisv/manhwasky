<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Component;

class Trending extends Component
{
    public $trending;

    public function getTrending()
    {
        $this->trending = Series::with('gallery')->orderBy('views', 'desc')->take(10)->get();    
    }
    
    public function render()
    {
        return view('livewire.pages.home.trending');
    }
}
