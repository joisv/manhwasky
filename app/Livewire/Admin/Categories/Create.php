<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    
    public $name;
    
    public function save()
    {
        if (auth()->user()->can('create')) {
            $this->validate([
                'name' => 'required|unique:categories,name|min:2|string'
            ]);

            Category::create([
                'name' => $this->name,
                'slug' => $this->setSlugAttribute($this->name)
            ]);
            $this->dispatch('re-render');
            $this->reset(['name']);
        }else{
            $this->alert('Kamu tidak memiliki izin');
        }
    }
    
    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 2;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
    
    public function render()
    {
        return view('livewire.admin.categories.create');
    }
}
