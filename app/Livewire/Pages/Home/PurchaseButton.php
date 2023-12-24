<?php

namespace App\Livewire\Pages\Home;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class PurchaseButton extends Component
{
    use LivewireAlert;
    
    public $series;
    #[Reactive]
    public $hasSeries;
    public $user;
    
    public function handlePurchase()
    {
        if (auth()->check()) {
            
            if ($this->user->coins >= $this->series->price) {
                $this->user->coins -= $this->series->price;
                $this->user->save();
                $this->user->purchasedSeries()->attach($this->series->id);
                $this->alert('success', 'Series berhasil dibuka 🥳🥳');
                $this->dispatch('close');
                $this->dispatch('has-series', series: $this->hasSeries);
            }else{
                $this->alert('error', 'coins kamu tidak cukup, dapatkan coins lagi');
            }
            
        } else{
            $this->alert('error', 'login dulu teman');
        }
    }
    
    public function render()
    {
        return view('livewire.pages.home.purchase-button');
    }
}
