<?php

namespace App\Livewire\Admin\Chapters;

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
        return Series::search('title', $this->searchSeries)->latest('id')->get();
    }

    public function restoreSeries($id)
    {
        $restoredGenre = Series::find($id);
        if ($restoredGenre) {
            if (!$this->series) {
                $this->series = collect();
            }
            $this->series->push($restoredGenre);
            $this->selectedSeries = collect($this->selectedSeries)->reject(function ($genre) use ($id) {
                return $genre['id'] == $id;
            })->toArray();
        }
        $this->dispatch('setSelectedSeries', $this->selectedSeries);
    }

    public function removeSeries($id)
    {
        // Menghapus genre dengan ID tertentu dari $this->series
        $this->series = $this->series->reject(function ($series) use ($id) {
            return $series->id == $id;
        });
    }

    public function setSelectedSeries($id, $name)
    {
        $this->removeSeries($id);
        $this->selectedSeries = [];
        $this->selectedSeries[] = ['id' => $id, 'name' => $name];
        $this->dispatch('setSelectedSeries', $this->selectedSeries);
    }

    #[On('create-chapter')]
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
        return view('livewire.admin.chapters.set-series');
    }
}
