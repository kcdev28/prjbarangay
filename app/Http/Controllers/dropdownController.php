<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\area;
use App\Models\civil;
use App\Models\religion;
use App\Models\special;

class dropdownController extends Controller
{
    public function create()
    {
        $areas = area::all();
        $civilStatuses = civil::all();
        $religions = religion::all();
        $specialStatuses = special::all();

        return view('registerResident', compact('areas', 'civilStatuses', 'religions', 'specialStatuses'));
    }
}
