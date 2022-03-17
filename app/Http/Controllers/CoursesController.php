<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;
use Auth;
use Validator;
use App\Models\Skill;

class CoursesController extends Controller
{

    public function courses(Request $request)
    {
        $data = array();
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
        	if(filter_var($request->get('skill'), FILTER_VALIDATE_INT)){
        		$data['skill'] = Skill::find($request->get('skill'));
        		$data['courses'] = Cours::where('skill_id','=', $request->get('skill'))->orderby('id', 'desc')->paginate(20);
        	}else{
        		$data['courses'] = Cours::orderby('id', 'desc')->paginate(20);
        	}
        }else{
            if(filter_var($request->get('skill'), FILTER_VALIDATE_INT)){
                $data['skill'] = Skill::find($request->get('skill'));
                $data['courses'] = Cours::where('user_id','=',Auth::user()->id)->where('skill_id','=', $request->get('skill'))->orderby('id', 'desc')->paginate(20);
            }else{
                $data['courses'] = Cours::orderby('id', 'desc')->paginate(20);
            }
        }
        return view('panel.courses', compact('data'));
    }

    public function create(Request $request)
    {
        $data = array();
    	if(filter_var($request->get('skill'), FILTER_VALIDATE_INT)){
			$data['skill'] = Skill::find($request->get('skill'));
    	}else{
    		$data['skills'] = Skill::all();
    	}
        return view('panel.courses_create', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1',
            'name' => 'required|min:1',
            'name_en' => 'required|min:1',
            'description' => 'required|min:1',
            'image' => 'required|min:1',
            'body' => 'required|min:0',
            'skill' => 'required|min:0',
            'level' => 'required|min:0',
            'type' => 'required|min:0',
            'publish' => 'required|min:0',
        ]);

        if (!$validator->fails()) {
            $cours = new Cours();
            $cours->title = trim($request->get('title'));
            $cours->name = trim($request->get('name'));
            $cours->name_en = str_replace(' ', '-', trim($request->get('name_en')));
            $cours->description = trim($request->get('description'));
            $cours->image = trim($request->get('image'));
            $body = $request->get('body');
            $body = str_replace('<html><head></head><body>','', $body);
            $body = str_replace('</body></html>','', $body);
            $cours->body = $body;
            $cours->active = 0;// default is active
            $cours->off = $request->get('off');
            $cours->level = $request->get('level');
            $cours->type = $request->get('type');
            $cours->publish = $request->get('publish');
            $cours->skill_id = $request->get('skill');
            $cours->user_id = Auth::user()->id;
            if ($cours->save()) {
                return redirect()->back()->withInput()->with(["success" => "Cours Created."]);
            } else {
                return redirect()->back()->withInput()->with(["error" => "Failed To Save Cours."]);
            }
        } else {
            return redirect()->back()->withInput()->with(["error" => "Form Input Has Invalid."]);
        }
    }

    public function changeActive(Request $request)
    {
        if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            $cours = Cours::find($request->get('id'));
            if ($cours) {
                if ($request->get('active') == 1) {
                    $cours->active = 1;
                } else {
                    $cours->active = 0;
                }
                $cours->update();
                return $cours->active;
            } else {
                return 'Error';
            }
        } else {
            return "error";
        }
    }


    public function delete(Request $request)
    {
        if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            $cours = Cours::find($request->get('id'));
            if ($cours) {
                $cours->delete();
                return 1;
            } else {
                return 'Error';
            }
        } else {
            return "error";
        }
    }

    public function edit(Request $request, $id)
    {
        $data = array();
        $data['cours'] = Cours::find($id);
        if ($data['cours']) {
            $data['skills'] = Skill::all();
            return view('panel.courses_edit', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function save_edit(Request $request, $id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
        }
        $cours = Cours::find($id);
        if ($cours) {

            $validator = Validator::make($request->all(), [
                'title' => 'required|min:1',
                'name' => 'required|min:1',
                'name_en' => 'required|min:1',
                'description' => 'required|min:1',
                'image' => 'required|min:1',
                'body' => 'required|min:1',
                'skill' => 'required|min:1',
                'level' => 'required|min:1',
                'type' => 'required|min:1',
                'publish' => 'required|min:1',
                'howsell' => 'required|min:1',
            ]);

            if (!$validator->fails()) {
                $cours->title = trim($request->get('title'));
                $cours->name = trim($request->get('name'));
                $cours->name_en = str_replace(' ', '-', trim($request->get('name_en')));
                $cours->description = trim($request->get('description'));
                $cours->image = trim($request->get('image'));
                $body = $request->get('body');
//                $body = str_replace('<html><head></head><body>','', $body);
//                $body = str_replace('</body></html>','', $body);
                $cours->body = $body;
                $cours->active = 0;// default is active
                $cours->price = $request->get('price');
                $cours->off = $request->get('off');
                $cours->howsell = $request->get('howsell');
                $cours->level = $request->get('level');
                $cours->type = $request->get('type');
                $cours->publish = $request->get('publish');
                $cours->skill_id = $request->get('skill');
                $cours->active = 0;
                if ($cours->save()) {
                    return redirect()->back()->withInput()->with(["success" => "Cours Updated."]);
                } else {
                    return redirect()->back()->withInput()->with(["error" => "Failed To Update This Cours."]);
                }
            } else {
                return redirect()->back()->withInput()->with(["error" => "Form Input Has Invalid."]);
            }
        } else {
            return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
        }
    }

    public function search(Request $request)
    {
        $data = [];
        if(strlen($request->get('s'))){
            $cours = Cours::where('title', 'like', '%'.$request->get('s').'%')->get();
            foreach ($cours as $cours){
                $data[]=[ 'title' => $cours->title, 'id' => $cours->id ];
            }
        }
        return json_encode($data);
    }
}
