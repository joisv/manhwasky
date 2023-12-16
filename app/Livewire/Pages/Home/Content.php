<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Component;

class Content extends Component
{
    public Series $series;
    public $sortDirection = 'desc';
    public $chapters;
    
    public $direction = true;

    public function setDirection()
    {
        $this->direction = ! $this->direction;

        if ($this->direction) {
            $this->sortDirection = 'desc';
        }else{
            $this->sortDirection = 'asc';
        }
        $this->getChapters();
    }
    
    public function getChapters() 
    {
        $this->chapters = $this->series->chapters()->orderBy('created', $this->sortDirection)->get();    
    }
    
    public function render()
    {
        return view('livewire.pages.home.content', [
            'series' => $this->series,
        ]);
    }
}
