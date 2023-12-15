<?php

namespace App\Livewire\Admin\Chapters;

use App\Models\Chapter;
use App\Models\ChapterContent;
use App\Models\Series;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    
    public $chapter;
    public $slug;
    public $created;
    public $isEdit = false;

    #[Validate('required|min:3|string')]
    public $title;
    #[Validate('required|min:3|string')]
    public $chapterStr;
    #[Validate('required')]
    public $selectedSeries = [];
    
    #[On('edit')]
    public function getEdit($value)
    {
        $this->isEdit = true;
        $this->chapter = Chapter::find($value);
        $this->title = $this->chapter->title;
        $this->slug = $this->chapter->slug;
        $this->created = $this->chapter->created;
        $this->created = $this->chapter->created;
        $this->chapterStr = implode(",\n", $this->chapter->contents()->pluck('url')->toArray());
        $this->selectedSeries = [];
        $this->selectedSeries[] = [
            'name' => $this->chapter->series->title,
            'id' => $this->chapter->series->id,
        ];
        $this->dispatch('editSeries', $this->selectedSeries);
    }
    
    #[On('setSelectedSeries')]
    public function evtSelectedSeries($value)
    {
        $this->selectedSeries = $value;
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
    
    public function save()
    {
        if (auth()->user()->can('create')) {
            $this->validate();
            $this->chapter->contents()->delete();
            $chapters = preg_split('/,\s*/', $this->chapterStr, -1, PREG_SPLIT_NO_EMPTY);
            $this->chapter->update([
                'title' => $this->title,
                'series_id' => $this->selectedSeries[0]['id'],
                'slug' => $this->slug,
                'created' => $this->created,
                'published_day' => Carbon::parse($this->created)->format('l')
            ]);
            foreach ($chapters as $chapterData) {
                ChapterContent::create([
                    'url' => $chapterData,
                    'chapter_id' => $this->chapter->id
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
    
    public function render()
    {
        return view('livewire.admin.chapters.edit');
    }
}
