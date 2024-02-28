<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Component;

class Trending extends Component
{
    public $trending;

    public function getTrending()
    {
        $this->trending = Series::with('gallery')
        ->orderByDesc('views') // Mengurutkan berdasarkan views secara descending
        ->take(8) // Mengambil 8 hasil teratas
        ->get();    
    }
    
    public function render()
    {
        return view('livewire.pages.home.trending');
    }
}
