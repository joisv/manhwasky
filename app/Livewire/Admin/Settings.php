<?php

namespace App\Livewire\Admin;

use App\Settings\GeneralSetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Settings extends Component
{
    use LivewireAlert;

    public string $site_name;
    public string $logo_cms;
    public string $favicon;
    public string $description;
    public string $logo;
    public string $primary_color = '#000000';
    public string $wichImage;

    public function mount(GeneralSetting $settings)
    {
        $this->site_name = $settings->site_name;
        $this->primary_color = $settings->primary_color;
        $this->logo_cms = $settings->logo_cms;
        $this->logo = $settings->logo;
        $this->favicon = $settings->favicon;
        $this->description = $settings->description;
    }

    public function update()
    {
        if (auth()->user()->hasRole('admin')) {
            $this->validate([
                'logo_cms' => 'nullable|string',
                'logo' => 'nullable|string',
                'favicon' => 'nullable|string',
                'description' => 'nullable|string',
                'site_name' => 'nullable|string',
                'primary_color' => 'required|string',
            ]);
    
            $settings = new GeneralSetting();
    
            $settings->site_name = $this->site_name;
            $settings->description = $this->description;
            $settings->logo_cms = $this->logo_cms;
            $settings->logo = $this->logo;
            $settings->favicon = $this->favicon;
            $settings->primary_color = $this->primary_color;
    
            $settings->save();
    
            $this->alert('success', 'settings updated');
        } else {
            $this->alert('error', 'kamu tidak memiliki izin');
        }
    }

    #[On('select-poster')]
    public function setSelectedposted($id, $url)
    {
        if ($this->wichImage === 'logo_cms') {
            # code...
            $this->logo_cms = $url;
        } elseif ($this->wichImage === 'logo') {
            $this->logo = $url;
        } else {
            $this->favicon = $url;
        }
    }
    
    #[On('wich-image')]
    public function setWichImage($props)
    {
        $this->wichImage = $props;
    }

    #[On('remove-img')]
    public function removePoster()
    {
        if (auth()->user()->hasRole('admin')) {
            if ($this->wichImage === 'logo_cms') {
                $this->logo_cms = '';
            } elseif ($this->wichImage === 'logo') {
                $this->logo = '';
            } else {
                $this->favicon = '';
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
