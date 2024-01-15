<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\Series;
use Livewire\Attributes\On;
use Livewire\Component;

class SetSeries extends Component
{

    public $selectedSeries = [];
    public $series;
    public $searchSeries;

    public function getSeries()
    {
        return Series::search('title', $this->searchSeries)->latest('id')->take(10)->get();
    }

    public function restoreSeries()
    {
        $this->series = $this->getSeries();
        $this->selectedSeries = [];
    }

    public function removeSeries($id)
    {
        // Menghapus genre dengan ID tertentu dari $this->series
        $this->series = $this->series->reject(function ($series) use ($id) {
            return $series->id == $id;
        });
    }

    public function setSelectedSeries($id, $title)
    {
        $this->removeSeries($id);
        $this->selectedSeries = [];
        $this->selectedSeries[] = ['id' => $id, 'title' => $title];
        $this->dispatch('setSelectedSeries', $this->selectedSeries[0]['id']);
    }

    #[On('create-slider')]
    public function isCreate()
    {
        $this->selectedSeries = [];
    }

    #[On('editSeries')]
    public function editSeries($value)
    {
        $this->selectedSeries = [];
        $this->selectedSeries = $value;
    }

    public function mount()
    {
        $this->series = $this->getSeries();
    }

    public function updatedSearchSeries()
    {
       $this->series = $this->getSeries();
    }
    
    public function render()
    {
        return view('livewire.admin.sliders.set-series');
    }
}
