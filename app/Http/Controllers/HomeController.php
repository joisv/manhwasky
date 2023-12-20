<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Settings\GeneralSetting;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{
    public $setting;
    
    public function __construct(GeneralSetting $generalSetting)
    {
        $this->setting = $generalSetting;
    }
    
    public function index()
    {
        return view('welcome', [
            'seo' => new SEOData(
                site_name: $this->setting->site_name,
                title: $this->setting->site_name,
                description: $this->setting->description,
                robots: 'nofollow, noindex',
            )
        ]); 
    }

    public function show(Series $series)
    {
        $series->increment('views');
        return view('content',[
            'series' => $series->load(['genres', 'gallery', 'chapters'])
        ]);    
    }
}
