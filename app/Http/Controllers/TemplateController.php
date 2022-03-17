<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cours;
use App\Models\Page;
use App\Models\Lesson;
use App\Models\Skill;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    /*
     * show home page
     */
    public function index(Request $request){
        $data = array();
        $data['skill_count'] = Skill::where('active','1')->count();
        $data['post_count'] = Lesson::where('active','1')->count();
        $data['cours_count'] = Cours::where('active','1')->count();
        $data['blog_count'] = Blog::where('active','1')->count();
        /*
         * get skills and number of courses and posts
         */
        $data['skills'] = array();
        $skills = DB::table('skills')
                                ->where('skills.active','=','1')
                                ->leftjoin('courses','skills.id','=','courses.skill_id')
                                ->groupBy('skills.id')
                                ->select('skills.*', DB::raw('count(skill_id) as cours_count'))
                                ->orderBy('cours_count','desc')
                                ->limit(10)
                                ->get()->toArray();
        foreach ($skills as $skill){
            $skill->post_count = Cours::where('skill_id','=',$skill->id)
                                        ->leftjoin('posts','posts.cours_id','=','courses.id')
                                        ->count();
            array_push($data['skills'], $skill);
        }

        /*
         * get the 11 new post
         */
        $data['posts'] = Lesson::join('courses','courses.id','=','lessons.cours_id')
                                ->join('skills','skills.id','=','courses.skill_id')
                                ->where('lessons.active','1')
                                ->where('courses.active','1')
                                ->orderby('lessons.updated_at','desc')
                                ->select(['lessons.id','lessons.title','lessons.title_en','lessons.description','skills.skill','courses.level','skills.skillen','skills.image as simage','skills.id as sid'])
                                ->limit(12)
                                ->get()
                                ->toArray();

        $data['blogs'] = Blog::join('users','blogs.user_id','=','users.id')
                                ->where('blogs.active',1)
                                ->select(['blogs.*','users.name'])
                                ->orderby('blogs.updated_at','desc')
                                ->limit(6)
                                ->get();

        $data['pages'] = Page::where('active',1)->get();

        return view('template.home',compact('data'));
    }

    /*
     * show skills list
     */
    public function skills(Request $request){
        $data = array();
        /*
         * get skills and number of courses and posts
         */
        $data['skills'] = array();
        $skills = DB::table('skills')
            ->leftjoin('courses','skills.id','=','courses.skill_id')
            ->groupBy('skills.id')
            ->select('skills.*', DB::raw('count(skill_id) as cours_count'))
            ->orderBy('cours_count','desc')
            ->limit(10)
            ->get()->toArray();
        foreach ($skills as $skill){
            $skill->post_count = Cours::where('skill_id','=',$skill->id)
                ->leftjoin('posts','posts.cours_id','=','courses.id')
                ->count();
            array_push($data['skills'], $skill);
        }

        $data['pages'] = Page::where('active',1)->get();

        return view('template.skills',compact('data'));
    }


    /*
     * show a skill
     */
    public function skill($skill,Request $request){
        if(strlen(trim($skill))) {
            $data = array();
            $data['skill'] = Skill::where('skillen','=',$skill)->limit(1)->get();
            if($data['skill']){
                $data['skill'] = $data['skill'][0];
                $data['courses'] =  Cours::withCount(['posts'])
                                            ->join('users', 'courses.user_id', '=', 'users.id')
                                            ->where('courses.skill_id','=',$data['skill']->id)
                                            ->where('courses.active','=',1)
                                            ->orderby('courses.updated_at','desc')
                                            ->addSelect('users.name')
                                            ->get();

                $data['pages'] = Page::where('active',1)->get();
                return view('template.courses', compact('data'));
            }
        }
        return redirect('/nofound');
    }
    /*
     * show a cours
     */
    public function cours($name, Request $request){
        if(strlen(trim($name))) {
            $data = array();
            $data['cours'] = Cours::where('name_en','=',$name)->where('active','=','1')->limit(1)->get();
            if($data['cours']){
                $data['cours'] = $data['cours'][0];
                $data['posts'] = Lesson::where('cours_id',$data['cours']->id)
                                        ->where('active','1')
                                        ->orderby('id','desc')
                                        ->get();
                $data['pages'] = Page::where('active',1)->get();

                return view('template.oncours', compact('data'));
            }
        }
        return redirect('/nofound');
    }
    /*
     * show a lesson
     */
    public function lesson($title_en,Request $request){
        if(strlen(trim($title_en))) {
            $data = array();
            $data['post'] = Lesson::join('users','lessons.user_id','=','users.id')
                                    ->where('lessons.title_en',$title_en)
                                    ->where('lessons.active',1)
                                    ->limit(1)
                                    ->select('lessons.*','users.name')
                                    ->get();
            if($data['post']){
                $data['post'] = $data['post'][0];

                DB::table('posts')
                    ->where('id', $data['post']->id)
                    ->update(['visit' => $data['post']->visit+1]);


                $data['posts'] = Lesson::where('cours_id',$data['post']->cours_id)
                                        ->where('active','1')
                                        ->get();
                $data['cours'] = Cours::find($data['post']->cours_id);
                $data['skill'] = Skill::find($data['cours']->skill_id);
                $data['pages'] = Page::where('active',1)->get();
                return view('template.onpost', compact('data'));
            }
        }
        return redirect('/nofound');
    }


    public function page($title){
        $data = [];
        $data['pages'] = Page::where('active',1)->get();
        $data['page'] = Page::where('title',$title)->limit(1)->get();
        if(count($data['page'])){
            $data['page'] = $data['page'][0];
            return view('template.page', compact('data'));
        }else{
            return abort(404);
        }
    }


    public function blogs(){
        $data = [];
        $data['pages'] = Page::where('active',1)->get();
        $data['blogs'] = Blog::join('users','blogs.user_id','=','users.id')
            ->where('blogs.active',1)
            ->select(['blogs.*','users.name'])
            ->orderby('id','desc')
            ->paginate(10);
        return view('template.blogs', compact('data'));
    }

    public function blog($id){
        if(filter_var($id, FILTER_VALIDATE_INT)){
            $data = [];
            $data['pages'] = Page::where('active',1)->get();
            $data['blog'] = Blog::join('users','blogs.user_id','=','users.id')
                                ->where('blogs.active',1)
                                ->where('blogs.id',$id)
                                ->select(['blogs.*','users.name'])
                                ->get();
            if(count($data['blog'])) {

                $blog = Blog::find($id);
                $blog->visit = $blog->visit + 1;
                $blog->update();

                $data['blog'] = $data['blog'][0];
                return view('template.blog', compact('data'));
            }
        }
        return abort(404);
    }

    public function sitemap(){
        return response()->view('sitemap.base')->header('Content-Type', 'text/xml');
    }
    public function sitemap_Skills(){
        $data = [];
        $data['skills'] = Skill::where('active','=','1')->get();
        return response()->view('sitemap.skills', compact('data'))->header('Content-Type', 'text/xml');
    }
    public function sitemap_Courses(){
        $data = [];
        $data['courses'] = Cours::join('skills','skills.id','=','courses.skill_id')
            ->where('skills.active','=','1')
            ->where('courses.active','=','1')
            ->select('courses.*')
            ->get();
        return response()->view('sitemap.courses', compact('data'))->header('Content-Type', 'text/xml');
    }
    public function sitemap_Lessons(){
        $data = [];
        $data['lessons'] = Lesson::join('courses','courses.id','=','posts.cours_id')
            ->join('skills','skills.id','=','courses.skill_id')
            ->where('skills.active','=','1')
            ->where('courses.active','=','1')
            ->where('posts.active','=','1')
            ->select('posts.*')
            ->get();
        return response()->view('sitemap.lessons', compact('data'))->header('Content-Type', 'text/xml');
    }
    public function sitemap_Blogs(){
        $data = [];
        $data['blogs'] = Blog::where('active','=','1')->get();
        return response()->view('sitemap.blogs', compact('data'))->header('Content-Type', 'text/xml');
    }
    public function sitemap_Pages(){
        $data = [];
        $data['pages'] = Page::where('active','=','1')->get();
        return response()->view('sitemap.pages', compact('data'))->header('Content-Type', 'text/xml');
    }

}
