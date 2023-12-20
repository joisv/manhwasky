<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Settings\GeneralSetting;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class GenreController extends Controller
{
    public function index(Request $request, GeneralSetting $generalSetting)
    {
        $staticGenre = Genre::withCount('series')
            ->orderByDesc('series_count')
            ->take(10)
            ->get();
        $genre = $request->input('g') ?? $staticGenre[0]->name;

        return view('genres', [
            'genre' => $genre,
            'staticGenre' => $staticGenre,
            'seo' => new SEOData(
                title: "Daftar Genre - $generalSetting->site_name",
                description: "Baca komik online gratis berdasarkan genre terbaru.",
                robots: 'nofollow, noindex',
            )
        ]);
    }
}
