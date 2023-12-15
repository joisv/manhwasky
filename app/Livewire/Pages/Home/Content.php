<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Component;

class Content extends Component
{
    public Series $series;
    
    public function render()
    {
        return view('livewire.pages.home.content', [
            'series' => $this->series
        ]);
    }
}
