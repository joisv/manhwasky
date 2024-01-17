<?php

namespace App\Livewire\Welcome;

use App\Models\Series;
use Livewire\Component;

class MobileSearch extends Component
{
    public string $searchInput;
    public $searchValue = [];

    public function updatedSearchInput($value)
    {
        if (!empty($value)) {
            # code...
            $this->searchValue = $this->getSearchValue($value);
        } else{
            $this->searchValue = [];
        }
    }
    
    public function getSearchValue($search)
    {
        return Series::search(['title', 'status', 'original_title'], $search)->take(10)->get();    
    }
    
    
    public function render()
    {
        return view('livewire.welcome.mobile-search');
    }
}
