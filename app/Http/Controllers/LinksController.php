<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Auth;
use Illuminate\Http\Request;

class LinksController extends Controller
{

    public function links(Request $request, $lesson){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if(filter_var($lesson, FILTER_VALIDATE_INT)){
                $data['links'] = Link::where('lesson_id',$lesson)->orderby('id', 'desc')->get();
                if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                    $data['link'] = Link::find($request->get('id'));
                    if (!$data['link']) {
                        return abort(404);
                    }
                }
                $data['lesson_id'] = $lesson;
                return view('panel.links', compact('data'));
            }else{
                return view('errors.403');
            }
        }else {
            return view('errors.403');
        }
    }

    public function store(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (strlen(trim($request->get('title'))) and filter_var($request->get('lesson'), FILTER_VALIDATE_INT)) {

                if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                    $link = Link::find($request->get('id'));
                    if (!$link) {
                        return redirect()->back()->withInput()->with(["error" => "Failed To Save New Links."]);
                    }
                } else {
                    $link = new Link();
                }
                $link->title = trim($request->get('title'));
                $link->size = trim($request->get('size'));
                $link->url = trim($request->get('url'));
                $link->lesson_id = $request->get('lesson');
                if ($link->save()) {
                    return redirect()->back()->with(["success" => "Saved."]);
                } else {
                    return redirect()->back()->withInput()->with(["error" => "Failed To Save New Category."]);
                }
            } else {
                return redirect()->back()->withInput()->with(["error" => "Form Input Is Invalid."]);
            }
        } else {
            return view('errors.403');
        }
    }
    public function delete(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                $link = Link::find($request->get('id'));
                if ($link) {
                    $link->delete();
                    return 1;
                } else {
                    return 'Error';
                }
            } else {
                return "error";
            }
        } else {
            return view('errors.403');
        }
    }
}
