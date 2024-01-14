<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\Slider;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;
    
    public $series_id;
    public $main;
    public $background = '#000000';
    
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
    
    public function setImg()
    {
        $this->dispatch('open-modal', 'add-image');
    }
    
    public function save()
    {
        $this->validate([
            'series_id' => 'required',
            'main' => 'nullable',
            'background' => 'nullable|string',
        ]);    

        Slider::create([
            'series_id' => $this->series_id,
            'main' => $this->main,
            'background' => $this->background,
        ]);

        $this->dispatch('close-modal');
        $this->alert('success', 'Slider created successfully');
        $this->reset(['series_id', 'main', 'background']);
    }
    
    public function render()
    {
        return view('livewire.admin.sliders.create');
    }
}
