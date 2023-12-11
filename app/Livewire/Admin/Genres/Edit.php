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

    public $name;
    public $slug;
    public $primary_color;

    protected $rules = [

        'name' => 'required|unique:genres,name|min:2|string',
    ];
    
    protected function rules()
    {
        $name = $this->name == $this->genre->name
            ? 'required|min:2|string'
            : '';

        return array_merge($this->rules, ['name' => $name]);
    }

    #[On('edit')]
    public function setEdit($value)
    {
        $this->genre = Genre::find($value);
        $this->name = $this->genre->name;
        $this->primary_color = $this->genre->primary_color;
    }

    public function save()
    {
        if (auth()->user()->can('update')) {
            $this->validate();

            $this->genre->update([
                'name' => $this->name,
                'slug' => $this->setSlugAttribute($this->name),
                'primary_color' => $this->primary_color
            ]);

            $this->dispatch('re-render');
            $this->alert('success', 'genre updated successfully');
            $this->reset(['name', 'slug', 'primary_color']);
        } else {
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
