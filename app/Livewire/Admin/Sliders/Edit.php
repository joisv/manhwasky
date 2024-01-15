<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\Series;
use App\Models\Slider;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    
    public $slider;
    public $main;
    public $series_id;
    public $background = '#000000';
    public $selectedSeries = [];
    
    #[On('setSelectedSeries')]
    public function setSeries($value)
    {
        $this->series_id = $value;    
    }
    
    #[On('select-poster')]
    public function setImage($id, $url)
    {
        $this->main = $url;
        $this->dispatch('image-selected');
    }
    
    #[On('remove-img')]
    public function removeImg()
    {
        $this->main = '';
    }
    
    #[On('edit')]
    public function getSliderEdit($id)
    {
        $this->slider = Slider::find($id);
        $this->selectedSeries = [];
        $this->selectedSeries[] = [
            'title' => $this->slider->series->title,
            'id' => $this->slider->series->id
        ];
        $this->dispatch('editSeries', $this->selectedSeries);
        $this->main = $this->slider->main;
        $this->background = $this->slider->background;
    }
    
    public function save()
    {
        $this->validate([
            'series_id' => 'required',
            'main' => 'nullable',
            'background' => 'nullable|string',
        ]);    

       $this->slider->update([
            'series_id' => $this->series_id,
            'main' => $this->main,
            'background' => $this->background,
        ]);

        $this->dispatch('close-modal');
        $this->alert('success', 'Slider created successfully');
        $this->reset(['series_id', 'main', 'background']);
    }
    
    public function setImg()
    {
        $this->dispatch('open-modal', 'add-image');
    }
    
    public function render()
    {
        return view('livewire.admin.sliders.edit');
    }
}
