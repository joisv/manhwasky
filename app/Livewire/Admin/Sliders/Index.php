<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\Slider;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;
    
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public string $search = '';
    public int $paginate = 10;

    public $mySelected = [];
    public $selectedAll = false;

    public function getSliders()
    {
        $query = Slider::search(['title', 'created_at'], $this->search)->orderBy($this->sortField, $this->sortDirection);

        // Jangan panggil get() di sini, biarkan query builder tetap sebagai objek query
        return $query;
    }

    public function updatedSelectedAll($val)
    {
        $val ? $this->mySelected = $this->getSliders()->limit($this->paginate)->pluck('id') : $this->mySelected = [];
    }

    public function updatedMySelected()
    {
        if (count($this->mySelected) === $this->paginate) {
            $this->selectedAll = true;
        } else {
            $this->selectedAll = false;
        }
    }

    public function updatedPage($page)
    {
        $this->mySelected = [];
        $this->selectedAll = false;
    }

    public function destroyAlert($value = '', $onConfirm = 'destroy')
    {
        $this->alert('warning', 'delete this posts ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => $onConfirm,
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'value' => $value
            ]
        ]);
    }

    #[On('delete')]
    public function deleteGenres($data)
    {
        if (auth()->user()->can('delete')) {
            $this->mySelected[] = $data['value'];
            $this->bulkDelete('deleted successfully');
        } else {
            $this->alert('error', 'kamu tidak memiliki izin');
            $this->mySelected = [];
            $this->selectedAll = false;
        }
    }
    
    #[On('destroy')]
    public function bulkDelete($message = 'bulk delete success')
    {
        if (auth()->user()->can('delete')) {
            if ($this->mySelected) {
                try {
                    //code...
                    Slider::whereIn('id', $this->mySelected)->delete();
                    $this->mySelected = [];
                    $this->selectedAll = false;
                    $this->alert('success', $message);
                } catch (\Throwable $th) {
                    $this->alert('error', 'series not found');
                }
            } else {
                $this->alert('error', 'series required');
            }
        } else {
            $this->alert('error', 'kamu tidak memiliki izin');
            $this->mySelected = [];
            $this->selectedAll = false;
        }
    }

    #[On('close-modal')]
    public function reRender()
    {

    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="w-full min-h-[60vh] flex justify-center items-center">
            <svg width="64px" height="64px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none" class="animate-spin"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="#f43f5e" fill-rule="evenodd" clip-rule="evenodd"> <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2"></path> <path d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"></path> </g> </g></svg>
            <span class="sr-only">Loading...</span>
        </div>
        HTML;
    }
    
    public function render()
    {
        $query = $this->getSliders()->paginate($this->paginate);
        
        return view('livewire.admin.sliders.index', [
            'sliders' => $query
        ]);
    }
}
