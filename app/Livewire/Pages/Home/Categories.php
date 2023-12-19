<?php

namespace App\Livewire\Pages\Home;

use App\Models\Series;
use Livewire\Attributes\Url;
use Livewire\Component;

class Categories extends Component
{
    public $categories;
    public $series;
    #[Url(as: 'cat')]
    public $category;
    #[Url(as: 'sort')]
    public $sortDirection = 'All';

    public function getSeriesCategory()
    {
        if (!empty($this->categories)) {
            $query = Series::with(['genres', 'category', 'gallery'])->whereHas('category', fn ($query) => $query->where('name', $this->category));

            if (!is_null($this->sortDirection) && $this->sortDirection !== 'All') {
                // validate the user input
                $this->validate([
                    'sortDirection' => 'in:Ongoing,Pending,Finish,Updated,Views'
                ]);

                if (in_array($this->sortDirection, ['Ongoing', 'Pending', 'Finish'])) {
                    $query->where('status', $this->sortDirection)->orderByDesc('views');
                } else {
                    $sort = $this->sortDirection === 'Updated' ? 'updated_at' : $this->sortDirection;
                    $this->series = $query->orderByDesc(strtolower($sort));
                }
            }

            $this->series = $query->get();
        }
    }


    public function mount($categories, $category)
    {
        $this->categories = $categories;
        $this->category = $category;
        $this->getSeriesCategory();
    }

    public function render()
    {
        return view('livewire.pages.home.categories');
    }
}
