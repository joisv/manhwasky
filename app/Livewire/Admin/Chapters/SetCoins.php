<?php

namespace App\Livewire\Admin\Chapters;

use Livewire\Attributes\On;
use Livewire\Component;

class SetCoins extends Component
{
    public $is_free;
    
    public function updated()
    {
        $this->is_free = filter_var($this->is_free, FILTER_VALIDATE_BOOLEAN);
        $this->dispatch('set-coins', is_free: $this->is_free);
    }
    
    #[On('edit-coins')]
    public function setCoins($is_free)
    {
        $this->is_free = $is_free;
    }
    
    public function render()
    {
        return view('livewire.admin.chapters.set-coins');
    }
}
