<?php

namespace App\Livewire\Pages\Home;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BookmarkSeries extends Component
{
    use LivewireAlert;
    
    public $hasSeries;
    public $series;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        if(auth()->check()){
            $this->isSeriesExist();    
        }
    }
    
    public function bookmarkSeries()
    {
        if (!auth()->check()) {
            $this->alert('warning', 'You need to login first');
            return;
        }

        try {
            if (!$this->hasSeries) {
                $this->user->bookmarkedSeries()->attach($this->series->id);
                $this->alert('success', 'Successfully save series');
                $this->hasSeries = true;
            } else {
                $this->user->bookmarkedSeries()->detach($this->series->id);
                $this->alert('success', 'Removed series');
                $this->hasSeries = false;
            }
            // $this->emitSelf('reRender');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }
    
    public function isSeriesExist()
    {
        $this->hasSeries = $this->user->bookmarkedSeries()->find($this->series->id) ? true : false;
    }
    
    public function render()
    {
        return view('livewire.pages.home.bookmark-series');
    }
}
