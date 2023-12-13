<?php

namespace App\Livewire\Pages\Home;

use App\Models\Slider;
use Livewire\Component;

class Sliders extends Component
{

    public function getSliders()
    {
        return Slider::all();
    }

    public function render()
    {
        return view('livewire.pages.home.sliders', [

            'sliders' => $this->getSliders()
            
        ]);
    }
}
