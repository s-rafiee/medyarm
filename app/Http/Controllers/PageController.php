<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Validator;
use Auth;
use App\Models\Language;

class PageController extends Controller
{
    public function pages()
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();
            $data['pages'] = Page::orderby('id', 'desc')
                                    ->join("languages","pages.language_id",'=','languages.id')
                                    ->select(['pages.*','languages.name'])
                                    ->paginate(20);
            return view('panel.pages', compact('data'));
        } else {
            return view('errors.403');
        }
    }

    public function create(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();
            $data['lan'] = Language::all();
            return view('panel.pages_create', compact('data'));
        } else {
            return view('errors.403');
        }
    }

    public function store(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:1',
                'description' => 'required|min:1',
                'image' => 'required|min:1',
                'body' => 'required|min:0',
                'language' => 'required|min:1',
            ]);
            if (!$validator->fails()) {
                $page = new Page();
                $page->title = trim($request->get('title'));
                $page->image = trim($request->get('image'));
                $page->description = trim($request->get('description'));
                $page->body = $request->get('body');
                $page->language_id = $request->get('language');
                $page->active = 1;
                if ($page->save()) {
                    return redirect()->back()->withInput()->with(["success" => "Page Created."]);
                } else {
                    return redirect()->back()->withInput()->with(["error" => "Failed To Save Page."]);
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
                $page = Page::find($request->get('id'));
                if ($page) {
                    $page->delete();
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

    public function changeActive(Request $request)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (filter_var($request->get('id'), FILTER_VALIDATE_INT)) {
                $page = Page::find($request->get('id'));
                if ($page) {
                    if ($request->get('active') == 1) {
                        $page->active = 1;
                    } else {
                        $page->active = 0;
                    }
                    $page->update();
                    return $page->active;
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

    public function edit(Request $request, $id)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();
            $data['page'] = Page::find($id);
            $data['lan'] = Language::all();
            if ($data['page']) {
                return view('panel.pages_edit', compact('data'));
            } else {
                return abort('404');
            }
        } else {
            return view('errors.403');
        }
    }

    public function save_edit(Request $request, $id)
    {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (!filter_var($id, FILTER_VALIDATE_INT)) {
                return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
            }
            $page = Page::find($id);
            if ($page) {
                $validator = Validator::make($request->all(), [
                    'title' => 'required|min:1',
                    'description' => 'required|min:1',
                    'image' => 'required|min:1',
                    'language' => 'required|min:1',
                    'body' => 'required|min:0',
                ]);
                if (!$validator->fails()) {
                    $page->title = trim($request->get('title'));
                    $page->image = trim($request->get('image'));
                    $page->description = trim($request->get('description'));
                    $page->body = $request->get('body');
                    $page->language_id = $request->get('language');
                    if ($page->save()) {
                        return redirect()->back()->withInput()->with(["success" => "Page Created."]);
                    } else {
                        return redirect()->back()->withInput()->with(["error" => "Failed To Save Page."]);
                    }
                } else {
                    return redirect()->back()->withInput()->with(["error" => "Form Input Is Invalid."]);
                }
            } else {
                return redirect()->back()->withInput()->with(["error" => "This Item Not Found."]);
            }
        } else {
            return view('errors.403');
        }
    }
}

