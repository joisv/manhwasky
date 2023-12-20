<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSetting;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class BookmarkController extends Controller
{
    public function index(GeneralSetting $generalSetting)
    {
        return view('bookmarks', [
            'seo' => new SEOData(
                title: "Bookmark - $generalSetting->site_name",
                description: "Daftar comic / manga favorit kamu",
                robots: 'nofollow, noindex',
            )
        ]);    
    }
}
