<?php

namespace App\Livewire\Admin\Series;

use Livewire\Component;

class SetCoins extends Component
{
    public $is_free = 1;
    public int $price = 0;
    
    public function updated()
    {
        $this->is_free = filter_var($this->is_free, FILTER_VALIDATE_BOOLEAN);
        $this->dispatch('set-coins', price: $this->price, is_free: $this->is_free);
    }
    public function render()
    {
        return view('livewire.admin.series.set-coins');
    }
}
