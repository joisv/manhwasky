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

    public $paginate = 20;
    public $images = [];

    // public function updatedImages($props)
    // {
    //     dd($props);
    // }
    
    public function render()
    {
        return view('livewire.admin.gallery.create', [
            'galleries' => $this->getGalleries()->paginate($this->paginate)
        ]);
    }

    public function saveImage()
    {
        if (auth()->user()->can('create')) {
            if (!empty($this->images)) {
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
                $this->images = [];
            }else {
                $this->alert('error', 'image tidak ditemukan');
            }
        } else {
            $this->alert('error', 'kamu tidak memiliki izin');
        }
    }

    #[On('delete-poster')]
    public function deletePoster($id)
    {
        if (auth()->user()->can('delete')) {
            # code...
            $gallery = Gallery::find($id);
            $gallery->delete();
            Storage::delete($gallery);
            $this->alert('success', 'image deleted successfully');
            $this->dispatch('re-render');
        } else {
            $this->alert('error', 'kamu tidak memiliki izin');
        }
    }

    #[On('alert-me')]
    public function alertMe($status, $message)
    {
        $this->alert($status, $message);
    }

    public function getGalleries()
    {
        return Gallery::latest('id');
    }
}
