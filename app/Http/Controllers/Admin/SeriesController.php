<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSetting;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(GeneralSetting $settings)
    {
        return view('admin/series/index', [
            'settings' => $settings
        ]);    
    }
}
