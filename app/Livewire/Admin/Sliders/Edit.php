<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\Slider;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    
    public $slider;
    public $title;
    public $description;
    public $main;
    public $background = '#000000';
    public $url;
    
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
        $this->title = $this->slider->title;
        $this->description = $this->slider->description;
        $this->main = $this->slider->main;
        $this->background = $this->slider->background;
        $this->url = $this->slider->url;
    }
    
    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:3',
            'main' => 'required',
            'url' => 'required|url',
            'background' => 'nullable|string',
            'description' => 'nullable|min:8|string'
        ]);    

       $this->slider->update([
            'title' => $this->title,
            'main' => $this->main,
            'background' => $this->background,
            'url' => $this->url,
            'description' => $this->description
        ]);

        $this->dispatch('close-modal');
        $this->alert('success', 'Slider created successfully');
        $this->reset(['title', 'main', 'background', 'description', 'url']);
    }
    
    public function setImg()
    {
        $this->dispatch('open-modal', 'edit-image');
    }
    
    public function render()
    {
        return view('livewire.admin.sliders.edit');
    }
}
