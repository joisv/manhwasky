<?php

namespace App\Livewire\Pages\Home;

use Livewire\Component;

class Preview extends Component
{
    public $series;
    
    public function render()
    {
        return view('livewire.pages.home.preview', [
            'preview' => $this->series->chapters()->orderBy('created', 'asc')->orderBy('id', 'asc')->first()
        ]);
    }
}
