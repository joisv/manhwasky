<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    
    public $name;
    public $slug;
    public $category;

    protected $rules = [

        'name' => 'required|unique:genres,name|min:2|string',
    ];
    
    protected function rules()
    {
        $name = $this->name == $this->category->name
            ? 'required|min:2|string'
            : '';

        return array_merge($this->rules, ['name' => $name]);
    }
    
    #[On('edit')]
    public function getEdit($value)
    {
        $this->category = Category::find($value);
        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
    }
    
    public function save()
    {
        if (auth()->user()->can('update')) {
            $this->validate();
            $this->category->update([
                'name' => $this->name,
                'slug' => $this->setSlugAttribute($this->name)
            ]);
    
            $this->reset(['name', 'slug']);
            $this->dispatch('re-render');
        }else{
            $this->alert('error', 'kamu tidak memiliki izin');
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
        return view('livewire.admin.categories.edit');
    }
}
