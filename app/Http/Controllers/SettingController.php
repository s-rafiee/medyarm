<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settings(){
        $data = array();

        return view('panel.settings', compact('data'));
    }
}
