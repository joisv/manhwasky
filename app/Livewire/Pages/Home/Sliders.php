<?php

namespace App\Livewire\Pages\Home;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Sliders extends Component
{

    public function getSliders()
    {
        $sliders = Cache::remember('sliders', 60 * 60, function(){
            return Slider::all();
        });

        return $sliders;
    }

    public function render()
    {
        return view('livewire.pages.home.sliders', [

            'sliders' => $this->getSliders()
            
        ]);
    }
}
