<?php

namespace App\Livewire\Pages\Home;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PurchaseButton extends Component
{
    use LivewireAlert;
    
    public $series;
    public $hasSeries;
    public $user;
    
    public function mount()
    {
        $this->user = Auth::user();
        if (auth()->check()) {
            $this->checkPurchasedSeries();
        }    
    }
    
    public function handlePurchase()
    {
        if (auth()->check()) {
            
            if ($this->user->coins > $this->series->coins) {
                $this->user->coins -= $this->series->coins;
                $this->user->save();
                $this->user->purchasedSeries()->attach($this->series->id);
                $this->alert('success', 'Series berhasil dibuka 🥳🥳');
            }else{
                $this->alert('error', 'coins kamu tidak cukup, dapatkan coins lagi');
            }
            
        } else{
            $this->alert('error', 'login dulu teman');
        }
    }
    
    public function checkPurchasedSeries()
    {
        $this->hasSeries = $this->user->purchasedSeries()->find($this->series->id) ? true : false;
    }
    
    public function render()
    {
        return view('livewire.pages.home.purchase-button');
    }
}
