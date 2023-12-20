<?php

namespace App\View\Components;

use App\Settings\GeneralSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SiteDataComposer
{
    public $setting;
    /**
     * Create a new component instance.
     */
    public function __construct(GeneralSetting $generalSetting)
    {
        $this->setting = $generalSetting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function compose(View $view)
    {

        // $setting = Cache::remember('settings', 60 * 60, function () {
        //     return SeoSetting::first(); // With method accepts two arguments, a key and a value   
        // });

        $view->with('setting', $this->setting);
    }
}
