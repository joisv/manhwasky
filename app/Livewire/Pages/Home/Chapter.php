<?php

namespace App\Livewire\Pages\Home;

use App\Models\Chapter as ModelsChapter;
use App\Models\Series;
use Carbon\Carbon;
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
        $this->prev = $this->getButton('created', '<', Carbon::parse($this->chapter->created));
        $this->next =  $this->getButton('created', '>', Carbon::parse($this->chapter->created));
    }
    
    public function getButton($column = 'created', $sign, $value)
    {
        return $this->series->chapters()
        ->where($column, $sign, $value)
        ->orWhere('id', $sign, $this->chapter->id)
        ->first();
    }
    
    public function render()
    {
        return view('livewire.pages.home.chapter');
    }
}
