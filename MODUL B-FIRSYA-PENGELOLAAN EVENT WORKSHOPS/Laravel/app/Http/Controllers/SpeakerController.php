<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    //
    public function index()
    {
        $speakers = \App\Models\Speaker::all();
        return view('speakers.index', compact('speakers'));
    }
}
