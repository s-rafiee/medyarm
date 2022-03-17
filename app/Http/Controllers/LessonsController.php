<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Validator;
use Auth;
use App\Models\Language;
use App\Models\Cat;

class LessonsController extends Controller
{
    public function lessons(Request $request)
    {
        $data = array();
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if ($request->get('cours_id')) {
                $data['lessons'] = Lesson::where('cours_id','=',$request->get('cours_id'))->orderby('id', 'desc')->select(['lessons.*'])->paginate(20);
                $data['cours'] = Cours::find($request->get('cours_id'));
            }else{
                $data['lessons'] = Lesson::orderby('id', 'desc')->select(['lessons.*'])->paginate(20);
            }
        } else {
            $data['posts'] = Lesson::where('user_id', Auth::user()->id)->orderby('id', 'desc')->paginate(20);
        }

        return view('panel.lessons', compact('data'));
    }

    public function create(Request $request)
    {
        $data = array();
        if ($request->get('cours_id')) {
            $data['cours'] = Cours::find($request->get('cours_id'));
        }
        return view('panel.lessons_create', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1',
            'title_en' => 'required|min:1',
            'description' => 'required|min:1',
            'image' => 'required|min:1',
            'body' => 'required|min:0',
            'cours' => 'required|min:1',
        ]);

        if (!$validator->fails()) {
            if(filter_var($request->get('cours'), FILTER_VALIDATE_INT)){
                    $cours = $request->get('cours');
                }else{
                $cours = Cours::where('title', trim($request->get('cours')))->get();
                if(count($cours)){
                    $cours = $cours[0]->id;
                }else{
                    return redirect()->back()->withInput()->with(["error" => "Cours Has Invalid."]);
                }
            }

            $post = new Lesson();
            $post->title = trim($request->get('title'));
            $post->title_en = str_replace(' ', '-', trim($request->get('title_en')));
            $post->description = trim($request->get('description'));
            $post->image = trim($request->get('image'));
            $body = $request->get('body');
            $body = str_replace('<html><head></head><body>','', $body);
            $body = str_replace('</body></html>','', $body);
            $post->body = $body;

            $post->active = 0;// default is active
            $post->user_id = Auth::user()->id;
            $post->cours_id = $cours;
            $post->visit = 0;

            if(strlen(trim($request->get('price')))){
                $post->price = trim($request->get('price'));
            }else{
                $post->price = 0;
            }

            if(strlen(trim($request->get('time')))){
                $post->time = trim($request->get('time'));
            }else{
                $post->time = '';
            }

            if(strlen(trim($request->get('link')))){
                $post->link = trim($request->get('link'));
            }else{
                $post->link = 0;
            }

            if ($post->save()) {
                return redirect()->back()->withInput()->with(["success" => "Lesson Created."]);
            } else {
                return redirect()->back()->withInput()->with(["error" => "Failed To Save Lesson."]);
            }
        } else {
            return redirect()->back()->withInput()->with(["error" => "Form Input Has Invalid."]);
        }
    }

    public function delete(Request $request)
    {
        if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            $post = Lesson::find($request->get('id'));
            if ($post and (true or Auth::user()->id == $post->user_id)) {
                $post->delete();
                return 1;
            } else {
                return 'Error';
            }
        } else {
            return "error";
        }
    }

    public function changeActive(Request $request)
    {
        if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            $post = Lesson::find($request->get('id'));
            if ($post and ( true or Auth::user()->id == $post->user_id)) {
                if ($request->get('active') == 1) {
                    $post->active = 1;
                } else {
                    $post->active = 0;
                }
                $post->update();
                return $post->active;
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
        $data['post'] = Lesson::find($id);
        if ($data['post'] and (true or Auth::user()->id == $data['post']->user_id)) {
            $data['cours'] = Cours::find($data['post']->cours_id);
            return view('panel.lessons_edit', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function save_edit(Request $request, $id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
        }
        $post = Lesson::find($id);
        if ($post and (true or Auth::user()->id == $post->user_id)) {


            $validator = Validator::make($request->all(), [
                'title' => 'required|min:1',
                'title_en' => 'required|min:1',
                'description' => 'required|min:1',
                'image' => 'required|min:1',
                'body' => 'required|min:0',
                'cours' => 'required|min:1',
            ]);

            if (!$validator->fails()) {
                $cours = Cours::where('title', trim($request->get('cours')))->get();
                if(count($cours)){
                    $cours = $cours[0]->id;
                }else{
                    return redirect()->back()->withInput()->with(["error" => "Cours Has Invalid."]);
                }
                $post->title = trim($request->get('title'));
                $post->title_en = str_replace(' ', '-', trim($request->get('title_en')));
                $post->description = trim($request->get('description'));
                $post->image = trim($request->get('image'));
                $body = $request->get('body');
                $body = str_replace('<html><head></head><body>','', $body);
                $body = str_replace('</body></html>','', $body);
                $post->body = $body;

                $post->active = 0;// default is active
                $post->cours_id = $cours;

                if(strlen(trim($request->get('price')))){
                    $post->price = trim($request->get('price'));
                }else{
                    $post->price = 0;
                }

                if(strlen(trim($request->get('time')))){
                    $post->time = trim($request->get('time'));
                }else{
                    $post->time = '';
                }

                if(strlen(trim($request->get('link')))){
                    $post->link = trim($request->get('link'));
                }else{
                    $post->link = 0;
                }

                if ($post->save()) {
                    return redirect()->back()->withInput()->with(["success" => "Lesson Updated."]);
                } else {
                    return redirect()->back()->withInput()->with(["error" => "Failed To Update This Lesson."]);
                }
            } else {
                return redirect()->back()->withInput()->with(["error" => "Form Input Has Invalid."]);
            }
        } else {
            return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
        }
    }
}
