<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Validator;
use Auth;

class SkillsController extends Controller
{
    public function skills()
    {
        $data = array();
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data['skills'] = Skill::orderby('id', 'desc')->paginate(20);
        }
        return view('panel.skills', compact('data'));
    }


    public function changeActive(Request $request)
    {
        if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            $skill = Skill::find($request->get('id'));
            if ($skill and (true)) {
                if ($request->get('active') == 1) {
                    $skill->active = 1;
                } else {
                    $skill->active = 0;
                }
                $skill->update();
                return $skill->active;
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
            $skill = Skill::find($request->get('id'));
            if ($skill and true) {
                $skill->delete();
                return 1;
            } else {
                return 'Error';
            }
        } else {
            return "error";
        }
    }


    public function create(Request $request)
    {
        $data = array();
        return view('panel.skill_create', compact('data'));
    }

    public function store(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
	        $validator = Validator::make($request->all(), [
	            'title' => 'required|min:1',
	            'skill' => 'required|min:1',
	            'skillen' => 'required|min:1',
	            'description' => 'required|min:1',
	            'image' => 'required|min:1',
	            'body' => 'required|min:0',
	        ]);

	        if (!$validator->fails()) {
	            $skill = new Skill();
	            $skill->title = trim($request->get('title'));
	            $skill->skill = trim($request->get('skill'));
	            $skill->skillen = str_replace(' ', '-', trim($request->get('skillen')));
	            $skill->description = trim($request->get('description'));
	            $skill->image = trim($request->get('image'));
	            $body = $request->get('body');
	            $body = str_replace('<html><head></head><body>','', $body);
	            $body = str_replace('</body></html>','', $body);
	            $skill->body = $body;
	            $skill->active = 0;// default is active

	            if ($skill->save()) {
	                return redirect()->back()->withInput()->with(["success" => "Skill Created."]);
	            } else {
	                return redirect()->back()->withInput()->with(["error" => "Failed To Save Skill."]);
	            }
	        } else {
	            return redirect()->back()->withInput()->with(["error" => "Form Input Has Invalid."]);
	        }
	    }else{
	    	return redirect()->back()->withInput()->with(["error" => "You Do Not Have The Necessary Access. Contact The Manager."]);
	    }
    }


    public function edit(Request $request, $id)
    {
        $data = array();
        $data['skill'] = Skill::find($id);
        if ($data['skill'] and true) {
            return view('panel.skills_edit', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function save_edit(Request $request, $id)
    {
//        return $request->all();
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
        }
        $skill = Skill::find($id);
        if ($skill and true) {

            $validator = Validator::make($request->all(), [
                'title' => 'required|min:1',
                'skill' => 'required|min:1',
                'skillen' => 'required|min:1',
                'description' => 'required|min:1',
                'image' => 'required|min:1',
                'body' => 'required|min:0',
            ]);

            if (!$validator->fails()) {
                $skill->title = trim($request->get('title'));
                $skill->skillen = str_replace(' ', '-', trim($request->get('skillen')));
                $skill->skill = trim($request->get('skill'));
                $skill->description = trim($request->get('description'));
                $skill->image = trim($request->get('image'));
                $body = $request->get('body');
	            $body = str_replace('<html><head></head><body>','', $body);
	            $body = str_replace('</body></html>','', $body);
	            $skill->body = $body;
                $skill->active = 0;
                if ($skill->save()) {
                    return redirect()->back()->withInput()->with(["success" => "Skill Updated."]);
                } else {
                    return redirect()->back()->withInput()->with(["error" => "Failed To Update This Skill."]);
                }
            } else {
                return redirect()->back()->withInput()->with(["error" => "Form Input Has Invalid."]);
            }
        } else {
            return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
        }
    }
}
