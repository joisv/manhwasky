<?php

namespace App\Livewire\Pages\Home;

use Livewire\Component;

class Chapter extends Component
{
    public $chapter;
    public $series;
    
    public function render()
    {
        return view('livewire.pages.home.chapter', [
            'chapter' => $this->chapter,
            'series' => $this->series,
        ]);
    }
}
