<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use DB;
use Auth;

class CatController extends Controller
{
    public function cats(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();
            $data['cats'] = Cat::orderby('id', 'desc')->get();
            if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                $data['cat'] = Cat::find($request->get('id'));
                if (!$data['cat']) {
                    return abort(404);
                }
            }
            return view('panel.cats', compact('data'));
        } else {
            return view('errors.403');
        }
    }

    public function store(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (strlen(trim($request->get('title'))) and strlen(trim($request->get('title_en'))) and is_numeric(trim($request->get('parent')))) {

                if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {

                    $oldname = Cat::where("title",trim($request->get('title')))->where('id','!=',$request->get('id'))->get();
                    if(count($oldname)){
                        return redirect()->back()->withInput()->with(["error" => "This 'Title' Has Already Been Used."]);
                    }
                    $oldname = Cat::where("title_en",trim($request->get('title_en')))->where('id','!=',$request->get('id'))->get();
                    if(count($oldname)){
                        return redirect()->back()->withInput()->with(["error" => "This 'Title En' Has Already Been Used."]);
                    }
                    $cat = Cat::find($request->get('id'));
                    if (!$cat) {
                        return redirect()->back()->withInput()->with(["error" => "Failed To Save New Category."]);
                    }
                } else {
                    $oldname = Cat::where("title",trim($request->get('title')))->where("title_en",trim($request->get('title_en')))->get();
                    if(count($oldname)){
                        return redirect()->back()->withInput()->with(["error" => "This Title Has Already Been Used."]);
                    }
                    $cat = new Cat();
                }
                $cat->title = trim($request->get('title'));
                $cat->title_en = trim($request->get('title_en'));
                $cat->parent = trim($request->get('parent'));
                if ($cat->save()) {
                    return redirect()->to('/dashboard/cats/')->with(["success" => "Saved."]);
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
                $cat = Cat::find($request->get('id'));
                if ($cat) {
                    DB::table('cats')->where('parent', $request->get('id'))->update(['parent' => 0]);
                    DB::table('posts')->where('type',$request->get('id'))->update(['type' => 0]);
                    $cat->delete();
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
