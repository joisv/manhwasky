<?php

namespace App\Livewire\Admin\Series;

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class SetSlug extends Component
{
    #[Modelable]
    public $value;
    
    public function render()
    {
        return view('livewire.admin.series.set-slug');
    }
}
