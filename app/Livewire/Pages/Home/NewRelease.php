<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Component;

class NewRelease extends Component
{
    // public $series;

    // public function getSeries()
    // {
    //     $this->series =    
    // }
    
    public function redirectTo($slug)
    {
        $this->redirect(route('content', $slug), navigate: true);    
    }
    
    public function render()
    {
        return view('livewire.pages.home.new-release', [
            'series' => Series::latest('id')->take(10)->get()
        ]);
    }
}
