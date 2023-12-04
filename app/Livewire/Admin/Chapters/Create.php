<?php

namespace App\Livewire\Admin\Chapters;

use App\Models\Chapter;
use App\Models\ChapterContent;
use App\Models\Series;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class Create extends Component
{
    use LivewireAlert;
    
    public $series;
    public $searchSeries;
    public $isEdit = false;
    
    public $created;
    public $slug;
    #[Validate('required')]
    public $selectedSeries = [];
    #[Validate('required|string|min:3')]
    public $title;
    #[Validate('required|string|min:3')]
    public $chapterStr;
    
    public function save()
    {
        $this->validate();
        $chapters = preg_split('/,\s*/', $this->chapterStr, -1, PREG_SPLIT_NO_EMPTY);
        $chapter = Chapter::create([
            'title' => $this->title,
            'series_id' => $this->selectedSeries[0]['id'],
            'slug' => $this->slug,
            'created' => $this->created
        ]);
        foreach ($chapters as $chapterData) {
            ChapterContent::create([
                'url' => $chapterData,
                'chapter_id' => $chapter->id
            ]);
        }
        $this->alert('success', 'Chapter created successfully');
        $this->dispatch('close-modal');
    }
    
    public function restoreSeries($id)
    {
        $restoredGenre = Series::find($id);
        if ($restoredGenre) {
            if (!$this->series) {
                $this->series = collect();
            }
            $this->series->push($restoredGenre);
            $this->selectedSeries = collect($this->selectedSeries)->reject(function ($genre) use ($id) {
                return $genre['id'] == $id;
            })->toArray();
        }
    }
    
    public function removeSeries($id)
    {
        // Menghapus genre dengan ID tertentu dari $this->series
        $this->series = $this->series->reject(function ($genre) use ($id) {
            return $genre->id == $id;
        });
    }
    
    public function setSelectedSeries($id, $name)
    {
        $this->removeSeries($id);
        $this->selectedSeries = [];
        $this->selectedSeries[] = ['id' => $id, 'name' => $name];
    }
    
    #[On('setslug')]
    public function setSlugAttribute()
    {
        $slug = Str::slug($this->title);
        $originalSlug = $slug;
        $count = 2;

        while (Series::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $this->slug = $slug;
    }
    
    public function render()
    {
        $this->series = $this->getSeries();
        return view('livewire.admin.chapters.create');
    }

    public function mount()
    {
        $this->created = Carbon::now();
    }
    
    public function getSeries()
    {
        return Series::search('title', $this->searchSeries)->latest('id')->get();
    }
}
