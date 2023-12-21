<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class CoinsModal extends Component
{
    public function getCoins()
    {
        if(auth()->check()){

            $token = Str::random(20);
            session(['coins-token' => $token]);
            $this->redirect(route('coins', ['token' => $token]), navigate:true);
        }else{
            $this->alert('error', 'ada yang salah deh keknya!!');
        }
    }
    
    public function render()
    {
        return view('livewire.coins-modal');
    }
}
