<?php

namespace App\Livewire\Pages\Home;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Bookmarks extends Component
{
    use LivewireAlert;
    
    public $user;
    public $bookmarks;

    public function mount()
    {

        if (auth()->check()) {
            # code...
            $this->user = auth()->user();
        }else{
            $this->alert('error', 'kamu perlu login');
        }
    }
    
    public function getBookmarks()
    {
        if (!empty($this->user)) {
            $this->bookmarks = $this->user->bookmarkedSeries()->get();
        } else{
            $this->bookmarks = [];
        }
    }

    public function render()
    {
        return view('livewire.pages.home.bookmarks');
    }
}
