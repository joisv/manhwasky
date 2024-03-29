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
    public $thumbnail;
    public $created;
    public $slug;
    #[Validate('required')]
    public $selectedSeries = [];
    #[Validate('required|string|min:3')]
    public $title;
    #[Validate('required|string|min:3')]
    public $chapterStr;
    public $is_free = 0;
    
    #[On('set-coins')]
    public function setCoins($is_free)
    {
        $this->is_free = $is_free;
    }
    
    public function updatedSelectedSeries()
    {
        dd('dasd');
      
    }
    
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
                'thumbnail' => $this->thumbnail,
                'is_free' => $this->is_free,
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
            $this->reset(['title', 'slug', 'chapterStr', 'thumbnail']);
            $this->created = Carbon::now();
        
        }else{
            $this->alert('error', 'kamu tidak memiliki izin');
        }
    }
    
    public function setImg()
    {
        $this->dispatch('open-modal', 'add-thumbnail');
    }
    
    #[On('select-poster')]
    public function setImage($id, $url)
    {
        $this->thumbnail = $url;
        $this->dispatch('image-selected');
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
        if (!empty($value)) {
            $series =  Series::find($this->selectedSeries[0]['id']);
            if (!empty($series)) {
                $this->is_free = $series->is_free;
                $this->dispatch('edit-coins', is_free: $this->is_free);
            }
        }
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
