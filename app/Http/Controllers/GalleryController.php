<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Auth;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery (Request $request, $post){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if(filter_var($post, FILTER_VALIDATE_INT)){
                $data['gallerys'] = Gallery::where('post_id',$post)->orderby('id', 'desc')->get();
                if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                    $data['gallery'] = Gallery::find($request->get('id'));
                    if (!$data['gallery']) {
                        return abort(404);
                    }
                }
                $data['post_id'] = $post;
                return view('panel.gallerys', compact('data'));
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
            if (strlen(trim($request->get('url'))) and filter_var($request->get('post'), FILTER_VALIDATE_INT)) {

                if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                    $gallery = Gallery::find($request->get('id'));
                    if (!$gallery) {
                        return redirect()->back()->withInput()->with(["error" => "Failed To Save New Category."]);
                    }
                } else {
                    $gallery = new Gallery();
                }
                $gallery->url = trim($request->get('url'));
                $gallery->post_id = $request->get('post');
                if ($gallery->save()) {
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
                $gallery = Gallery::find($request->get('id'));
                if ($gallery) {
                    $gallery->delete();
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
