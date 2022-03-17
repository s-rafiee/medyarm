<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function medias(){
        $data = array();

        return view('panel.medias', compact('data'));
    }
}
