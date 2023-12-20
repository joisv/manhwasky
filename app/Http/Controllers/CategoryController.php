<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Settings\GeneralSetting;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class CategoryController extends Controller
{
    public function index(Request $request, GeneralSetting $generalSetting)
    {
        $allcategories = Category::latest('id')->get();
        $categoryname =  $request->input('cat') ?? ($allcategories->isNotEmpty() ? $allcategories[0]->name : null);
        return view('categories', [
            'allcategories' => $allcategories,
            'categoryname' => $categoryname,
            'seo' => new SEOData(
                title: "Daftar Category - $generalSetting->site_name",
                description: "Baca komik online gratis berdasarkan category terbaru.",
                robots: 'nofollow, noindex',
            )
        ]);
    }
}
