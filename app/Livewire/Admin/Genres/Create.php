<?php

namespace App\Livewire\Admin\Genres;

use App\Models\Genre;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;

class Create extends Component
{
    use LivewireAlert;
    
    #[Validate('required|unique:genres,name|min:2|string')]
    public $name;
    public $slug;
    public $primary_color = '#000000';

    public function save()
    {
        if (auth()->user()->can('create')) {
           
            $this->validate();
    
            Genre::create([
                'name' => $this->name,
                'slug' => $this->setSlugAttribute($this->name),
                'primary_color' => $this->primary_color
            ]);
    
            $this->dispatch('re-render');
            $this->alert('success', 'genre created successfully');
            $this->reset(['name', 'slug', 'primary_color']);
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
        return view('livewire.admin.genres.create');
    }
}
