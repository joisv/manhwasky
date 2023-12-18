<?php

namespace App\Livewire\Pages\Home;

use App\Models\Chapter as ModelsChapter;
use App\Models\Series;
use Livewire\Component;

class Chapter extends Component
{
    public $chapter;
    public $series;
    
    public function mount(Series $series, ModelsChapter $chapter)
    {
        $this->series = $series;    
        $this->chapter = $chapter;    
    }
    
    public function render()
    {
        return view('livewire.pages.home.chapter');
    }
}
