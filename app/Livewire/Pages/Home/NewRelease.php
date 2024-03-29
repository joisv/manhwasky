<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Component;

class NewRelease extends Component
{
    
    public function render()
    {
        return view('livewire.pages.home.new-release', [
            'series' => Series::latest('id')->take(9)->get()
        ]);
    }
}
