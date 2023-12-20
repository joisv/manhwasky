<?php

namespace App\Livewire\Welcome;
use App\Livewire\Actions\Logout;
use App\Settings\GeneralSetting;
use Livewire\Component;

class Navigation extends Component
{
    
    public function logout(Logout $logout) {
        $logout();
    
        $this->redirect('/', navigate: true);
    }
    
    public function render(GeneralSetting $generalSetting)
    {
        return view('livewire.welcome.navigation', [
            'setting' => $generalSetting
        ]);
    }
}
