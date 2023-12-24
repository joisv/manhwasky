<?php

namespace App\Livewire;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetCoins extends Component
{
    use LivewireAlert;
    public $token;

    public function validateCoins(Request $request)
    {
        $session_token = $request->session()->get('coins-token', '');

        if (auth()->check()) {
            if (!empty($session_token)) {
                if ($session_token === $this->token) {
                    $user = auth()->user();
                    $user->coins += 2;
                    $user->save();
                    Session::forget('coins-token');
                    $this->alert('success', '2 coin ditambahkan');
                    $this->dispatch('redirect-to');
                } else {
                    $this->alert('error', 'ada yang salah!');
                }
            } else {
                $this->alert('error', 'token mana token!!');
            }
        } else {
            $this->alert('error', 'login dulu bjir');
        }
    }

    public function render()
    {
        return view('livewire.get-coins');
    }
}
