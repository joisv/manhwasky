<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetCoins extends Component
{
    use LivewireAlert;
    public $token;

    public function mount(Str $str)
    {
        $this->token = $str;

        if (empty($this->token)) {
            $this->alert('error', 'ada yang salah guys');
            $this->redirect(route('home'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.get-coins');
    }
}
