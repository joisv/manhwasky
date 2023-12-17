<?php

namespace App\Livewire\Admin\Series;

use App\Models\Category;
use App\Models\Genre;
use Livewire\Component;

class SetCategory extends Component
{
    public $categories;
    public $selectedCategory = [];
    public $searchCategory;
    public $series;

    public function restoreCategory($id)
    {
        $restoredGenre = Category::find($id);
        
        if ($restoredGenre) {
            // Pastikan $this->categories memiliki jenis model yang sama dengan $restoredGenre
            if (!$this->categories) {
                $this->categories = collect();
            }
    
            $this->categories->push($restoredGenre);
    
            // Pastikan $this->selectedCategory juga berisi objek Genre
            $this->selectedCategory = collect($this->selectedCategory)->reject(function ($category) use ($id) {
                return $category['id'] == $id;
            })->toArray();
        }
    // dd($this->selectedCategory);
        $this->dispatch('setSelectedCategory', $this->selectedCategory);
    }
    

    public function removeCategory($id)
    {
        // Menghapus genre dengan ID tertentu dari $this->categories
        $this->categories = $this->categories->reject(function ($series) use ($id) {
            return $series->id == $id;
        });
    }

    public function setSelectedCategory($id, $name)
    {
        $this->removeCategory($id);
        $this->selectedCategory = [];
        $this->selectedCategory[] = ['id' => $id, 'name' => $name];
        // dd($this->selectedCategory);
        $this->dispatch('setSelectedCategory', $this->selectedCategory[0]['id']);
    }
    
    public function mount()
    {
        $this->categories = Category::search('name', $this->searchCategory)->orderBy('name', 'desc')->get();
        $this->selectedCategory[] = [
            'id' => $this->series?->category->id,
            'name' => $this->series?->category->name
        ];    
    }
    
    public function render()
    {
        return view('livewire.admin.series.set-category');
    }
}
