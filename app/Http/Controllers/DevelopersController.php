<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use DB;
use Auth;

class DevelopersController extends Controller
{
    public function developers(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();
            $data['developers'] = Developer::orderby('id', 'desc')->paginate(20);
            if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                $data['developer'] = Developer::find($request->get('id'));
                if (!$data['developer']) {
                    return abort(404);
                }
            }
            return view('panel.developers', compact('data'));
        } else {
            return view('errors.403');
        }
    }


    public function store(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (strlen(trim($request->get('name')))) {

                if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {

                    $oldname = Developer::where("name",trim($request->get('name')))->where('id','!=',$request->get('id'))->get();
                    if(count($oldname)){
                        return redirect()->back()->withInput()->with(["error" => "This Name Has Already Been Used."]);
                    }
                    $developer = Developer::find($request->get('id'));
                    if (!$developer) {
                        return redirect()->back()->withInput()->with(["error" => "Failed To Save New Category."]);
                    }
                } else {
                    $developer = Developer::where("name",trim($request->get('name')))->get();
                    if(count($developer)){
                        return redirect()->back()->withInput()->with(["error" => "This Name Has Already Been Used."]);
                    }
                    $developer = new Developer();
                }
                $developer->name = trim($request->get('name'));
                if ($developer->save()) {
                    return redirect()->to('/dashboard/developers/')->with(["success" => "Saved."]);
                } else {
                    return redirect()->back()->withInput()->with(["error" => "Failed To Save New Artist."]);
                }
            } else {
                return redirect()->back()->withInput()->with(["error" => "Form Input Is Invalid."]);
            }
        } else {
            return view('errors.403');
        }
    }
    public function update_status(Request $request){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
//            $developer = Developer::find($request->get('id'));
//            if($developer){
//                if($developer->active){
//                    $developer->active = 0;
//                }else{
//                    $developer->active = 1;
//                }
//                $developer->update();
//                return $developer->active;
//            }else{
//                return 'error';
//            }
        } else {
            return view('errors.403');
        }
    }

    public function delete(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                $developer = Developer::find($request->get('id'));
                if ($developer) {
//                    DB::table('cats')->where('parent', $request->get('id'))->update(['parent' => 0]);
//                    DB::table('posts')->where('type',$request->get('id'))->update(['type' => 0]);
                    $developer->delete();
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

    public function search(Request $request)
    {
        $data = [];
        if(strlen($request->get('s'))){
            $developers = Developer::where('name', 'like', '%'.$request->get('s').'%')->get();
            foreach ($developers as $developer){
                $data[]=[ 'title' => $developer->name, 'id' => $developer->id ];
            }
        }
        return $data;
        return json_encode($data);
    }
}
