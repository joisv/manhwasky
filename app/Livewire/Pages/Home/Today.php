<?php

namespace App\Livewire\Pages\Home;

use App\Models\Chapter;
use App\Models\Series;
use Carbon\Carbon;
use Livewire\Component;

class Today extends Component
{
    public $loading = true;
    public $chapters;
    public $selectedDay;
    public $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    public function mount()
    {
        Carbon::setLocale('en');

        // Get the current day name
        $currentDayName = Carbon::now()->format('l');

        // Check if the current day name is valid
        if (in_array($currentDayName, $this->days)) {
            $this->selectedDay = $currentDayName;
        } else {
            // Handle the case where the current day name is not in the list
            $this->selectedDay = 'Unknown Day';
        }
    }

    public function getSeries()
    {
        $this->loading = true;
        $this->chapters = Chapter::with(['series', 'series.genres', 'series.gallery'])->where('published_day', $this->selectedDay)->get();
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.pages.home.today');
    }
}
