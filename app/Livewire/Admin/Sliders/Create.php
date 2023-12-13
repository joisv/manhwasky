<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\Slider;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;
    
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
    
    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:3',
            'main' => 'required',
            'url' => 'required|url',
            'background' => 'nullable|string',
            'description' => 'nullable|min:8|string'
        ]);    

        Slider::create([
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
    
    public function render()
    {
        return view('livewire.admin.sliders.create');
    }
}