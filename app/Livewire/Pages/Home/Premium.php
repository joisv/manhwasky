<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Component;

class Premium extends Component
{

    public function redirectTo($slug)
    {
        $this->redirect(route('content', $slug), navigate: true);    
    }
    
    public function getPremiums()
    {
        return Series::where('is_free', 0)->with('genres', 'category')->take(10)->get();
    }
    
    public function render()
    {
        return view('livewire.pages.home.premium', [
            'premiums' => $this->getPremiums()
        ]);
    }
}
