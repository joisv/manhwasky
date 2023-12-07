<?php

namespace App\Livewire\Admin\Genres;

use App\Models\Genre;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class Edit extends Component
{
    use LivewireAlert;

    public $genre;
    
    #[Validate('required|unique:genres,name|min:2|string')]
    public $name;
    public $slug;

    #[On('edit')]
    public function setEdit($value)
    {
        $this->genre = Genre::find($value);
        $this->name = $this->genre->name;
    }
    
    public function save()
    {
        if (auth()->user()->can('update')) {
            $this->validate();
    
            Genre::create([
                'name' => $this->name,
                'slug' => $this->setSlugAttribute($this->name)
            ]);
    
            $this->dispatch('re-render');
            $this->alert('success', 'genre updated successfully');
            $this->reset(['name', 'slug']);
        }else{
            $this->alert('error', 'kamu tidak memiliki izin');
        }
        
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 2;

        while (Genre::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
    
    public function render()
    {
        return view('livewire.admin.genres.edit');
    }
}
