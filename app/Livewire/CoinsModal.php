<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CoinsModal extends Component
{
    use LivewireAlert;

    public function getCoins()
    {
        if(auth()->check()){

            $token = Str::random(20);
            session(['coins-token' => $token]);
            $this->redirect(route('coins', ['token' => $token]), navigate:true);
            $this->dispatch('close-modal');
        }else{
            $this->alert('error', 'ada yang salah deh keknya!!, login dulu');
        }
    }
    
    public function render()
    {
        return view('livewire.coins-modal');
    }
}
