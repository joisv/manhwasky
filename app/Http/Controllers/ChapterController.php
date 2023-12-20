<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Series;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Series $series, Chapter $chapter)
    {
        return view('chapter',[
            'series' => $series,
            'chapter' => $chapter
        ]);
    }
}
