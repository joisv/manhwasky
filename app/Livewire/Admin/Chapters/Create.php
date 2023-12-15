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
        if (auth()->user()->can('create')) {
            $this->validate();
            $chapters = preg_split('/,\s*/', $this->chapterStr, -1, PREG_SPLIT_NO_EMPTY);
            $chapter = Chapter::create([
                'title' => $this->title,
                'series_id' => $this->selectedSeries[0]['id'],
                'slug' => $this->slug,
                'created' => $this->created,
                'published_day' => Carbon::parse($this->created)->format('l')
            ]);
            foreach ($chapters as $chapterData) {
                ChapterContent::create([
                    'url' => $chapterData,
                    'chapter_id' => $chapter->id
                ]);
            }
            $this->alert('success', 'Chapter created successfully');
            $this->dispatch('close-modal');
            $this->reset(['title', 'slug', 'chapterStr']);
            $this->created = Carbon::now();
        
        }else{
            $this->alert('error', 'kamu tidak memiliki izin');
        }
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
    
    #[On('setSelectedSeries')]
    public function evtSelectedSeries($value)
    {
        $this->selectedSeries = $value;
    }
    
    public function render()
    {
        return view('livewire.admin.chapters.create');
    }

    public function mount()
    {
        $this->created = Carbon::now();
    }
    
    
}
