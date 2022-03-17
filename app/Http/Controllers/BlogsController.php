<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Validator;
use Auth;

class BlogsController extends Controller
{
    public function blogs()
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();
            $data['blogs'] = Blog::orderby('id', 'desc')
                ->paginate(20);
            return view('panel.blogs', compact('data'));
        } else {
            return view('errors.403');
        }
    }

    public function create(Request $request)
    {
        $data = array();
        if ($request->get('blog')) {
            $data['blog'] = Blog::find($request->get('blog'));
        }
        return view('panel.blogs_create', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1',
            'title_en' => 'required|min:1',
            'description' => 'required|min:1',
            'image' => 'required|min:1',
            'body' => 'required|min:0',
        ]);

        if (!$validator->fails()) {
            $post = new Blog();
            $post->title = trim($request->get('title'));
            $post->title_en = str_replace(' ', '-', trim($request->get('title_en')));
            $post->description = trim($request->get('description'));
            $post->image = trim($request->get('image'));
            $body = $request->get('body');
            $body = str_replace('<html><head></head><body>', '', $body);
            $body = str_replace('</body></html>', '', $body);
            $post->body = $body;

            $post->active = 0;// default is active
            $post->user_id = Auth::user()->id;
            $post->visit = 0;

            if ($post->save()) {
                return redirect()->back()->withInput()->with(["success" => "Blog Created."]);
            } else {
                return redirect()->back()->withInput()->with(["error" => "Failed To Save Blog."]);
            }
        } else {
            return redirect()->back()->withInput()->with(["error" => "Form Input Has Invalid."]);
        }
    }

    public function delete(Request $request)
    {
        if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
            $post = Blog::find($request->get('id'));
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
            $post = Blog::find($request->get('id'));
            if ($post and (true or Auth::user()->id == $post->user_id)) {
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
        $data['blog'] = Blog::find($id);
        if ($data['blog'] and (true or Auth::user()->id == $data['post']->user_id)) {
            return view('panel.blogs_edit', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function save_edit(Request $request, $id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
        }
        $post = Blog::find($id);
        if ($post and (true or Auth::user()->id == $post->user_id)) {


            $validator = Validator::make($request->all(), [
                'title' => 'required|min:1',
                'title_en' => 'required|min:1',
                'description' => 'required|min:1',
                'image' => 'required|min:1',
                'body' => 'required|min:0',
            ]);

            if (!$validator->fails()) {
                $post->title = trim($request->get('title'));
                $post->title_en = str_replace(' ', '-', trim($request->get('title_en')));
                $post->description = trim($request->get('description'));
                $post->image = trim($request->get('image'));
                $body = $request->get('body');
                $body = str_replace('<html><head></head><body>','', $body);
                $body = str_replace('</body></html>','', $body);
                $post->body = $body;

                $post->active = 0;// default is active

                if ($post->save()) {
                    return redirect()->back()->withInput()->with(["success" => "Blog Updated."]);
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
