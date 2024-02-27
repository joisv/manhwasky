<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class Content extends Component
{
    use LivewireAlert;

    public Series $series;
    public $sortDirection = 'desc';
    public $chapters;
    public $user;
    public $firstChapter;
    public $hasSeries;

    public $direction = true;

    public function setDirection()
    {
        $this->direction = !$this->direction;

        if ($this->direction) {
            $this->sortDirection = 'desc';
            $this->getChapters();
        } else {
            $this->sortDirection = 'asc';
            $this->chapters->reverse();
        }
    }

    public function getChapters()
    {
        $this->chapters = $this->series->chapters()->orderBy('created', $this->sortDirection)->orderBy('id', $this->sortDirection)->get();
    }

    public function chapterRead($chapter_is_free, $slug)
    {
        if ($chapter_is_free || $this->series->is_free || $this->hasSeries) {
           $this->redirect(route('chapter', [$this->series->title, $slug]), navigate: true);
        } else{
            if (auth()->check()) {
                // ganti jumlah required coin mengambil dari setting
                if ($this->user->coins >= 2) {
                    $this->user->coins -= 2;
                    $this->user->save();
                    $this->redirect(route('chapter', [$this->series->title, $slug]), navigate: true);
                } else {
                    $this->dispatch('open-modal', 'coins-required');
                }
            }
        }
    }
    
    public function startRead()
    {
        $free = $this->series->is_free;

        if (!$free) {
            if ($this->firstChapter->is_free) {
                $this->redirect(route('chapter', [$this->series->title, $this->firstChapter->slug]), navigate: true);
            } else {
                if (auth()->check()) {
                    // ganti jumlah required coin mengambil dari setting
                    if ($this->user->coins >= 2) {
                        $this->user->coins -= 2;
                        $this->user->save();
                        $this->redirect(route('chapter', [$this->series->title, $this->firstChapter->slug]), navigate: true);
                    } else {
                        $this->dispatch('open-modal', 'coins-required');
                    }
                }
            }
        } else {
            $this->redirect(route('chapter', [$this->series->title, $this->firstChapter->slug]), navigate: true);
        }
    }

    #[On('has-series')]
    public function FunctionName($series)
    {
        $this->hasSeries = $series;
        $this->checkPurchasedSeries(); 
    }
    
    #[On('coins')]
    public function getCoins()
    {
        if (auth()->check()) {

            $token = Str::random(20);
            session(['coins-token' => $token]);
            $this->redirect(route('coins', ['token' => $token]), navigate: true);
            $this->dispatch('close-modal');
        } else {
            $this->alert('error', 'ada yang salah deh keknya!!, login dulu');
        }
    }

    public function mount()
    {
        $this->firstChapter = $this->series->chapters()->first();
        if (auth()->check()) {
            $this->user = Auth::user();
            $this->checkPurchasedSeries();
        }
    }

    public function checkPurchasedSeries()
    {
        $this->hasSeries = $this->user->purchasedSeries()->find($this->series->id) ? true : false;
    }
    
    public function render()
    {
        return view('livewire.pages.home.content', [
            'series' => $this->series,
        ]);
    }
}
