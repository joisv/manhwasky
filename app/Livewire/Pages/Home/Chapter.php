<?php

namespace App\Livewire\Pages\Home;

use App\Models\Chapter as ModelsChapter;
use App\Models\Series;
use Livewire\Component;

class Chapter extends Component
{
    public $chapter;
    public $series;
    public $prev;
    public $next;
    
    public function mount(Series $series, ModelsChapter $chapter)
    {
        $this->series = $series;    
        $this->chapter = $chapter;
        $this->prev = $this->getButton('id', '<', $this->chapter->id);
        $this->next =  $this->getButton('id', '>', $this->chapter->id);
    }
    
    public function getButton($column = 'id', $sign, $value)
    {
        return ModelsChapter::where($column, $sign, $value)->pluck('slug')->first();
    }
    
    public function render()
    {
        return view('livewire.pages.home.chapter');
    }
}
