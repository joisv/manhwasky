<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    
    public $galleries;
    public $images = [];

    
    public function render()
    {
        return view('livewire.admin.gallery.create', [
            'galleries' => $this->galleries
        ]);
    }
    
    public function saveImage()
    {
        $this->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        foreach ($this->images as $image) {
            Gallery::create([
                'image' => $image->store('galleries')
            ]);
        }

        $this->alert('success', 'upload success');
        $this->dispatch('re-render');
    }
    
    #[On('delete-poster')]
    public function deletePoster($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        Storage::delete($gallery);
        $this->alert('success', 'image deleted successfully');
        $this->dispatch('re-render');
    }
    
    #[On('alert-me')]
    public function alertMe($status, $message){
        $this->alert($status, $message);
    }
    
    public function mount() 
    {
        $this->getGalleries();
    }

    public function getGalleries()
    {
        $this->galleries = Gallery::all();
    }

}
