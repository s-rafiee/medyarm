<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Role_User;
use Auth;
use DB;

class UserController extends Controller
{
    public function users(){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();
            $data['users'] = User::leftjoin('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftjoin('roles', 'roles.id', '=', 'role_user.role_id')
                ->select(['users.*', 'roles.name as role_name'])
                ->orderby('id', 'desc')
                ->paginate(20);
            return view('panel.users', compact('data'));
        }else{
            return view('errors.403');
        }
    }

    public function changeActive(Request $request){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (filter_var($request->get('uid'), FILTER_VALIDATE_INT)) {
                $user = User::find($request->get('uid'));
                if ($user) {
                    if ($request->get('active') == 1) {
                        $user->active = 1;
                    } else {
                        $user->active = 0;
                    }
                    $user->update();
                    return $user->active;
                } else {
                    return 'Error';
                }
            } else {
                return "error";
            }
        }else {
            return view('errors.403');
        }
    }

    public function delete(Request $request){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (filter_var($request->get('uid'), FILTER_VALIDATE_INT)) {
                $user = User::find($request->get('uid'));
                if ($user) {
                    $user->delete();
                    DB::table('role_user')->where('user_id',$request->get('uid'))->delete();
                    return 1;
                } else {
                    return 'Error';
                }
            } else {
                return "error";
            }
        }else {
            return view('errors.403');
        }
    }

    public function edit(Request $request,$id){
//        if(Auth::user()->hasRole('administrator') or Auth::user()->id == $id) {
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            if (filter_var($id, FILTER_VALIDATE_INT)) {
                $data = array();
                $data['user'] = User::find($id);
                $data['role'] = Role_User::join('roles', 'role_id', '=', 'roles.id')
                                            ->where('user_id',$id)
                                            ->select('roles.*')
                                            ->get();
                if ($data['user'] and $data['role']) {
                    if(count($data['role'])){
                        $data['role'] = $data['role'][0]->name;
                    }else{
                        $data['role'] = "author";
                    }
                    return view('panel.users_edit', compact('data'));
                }
            }
            return view('errors.404');
        }else {
            return view('errors.403');
        }
    }

    public function save_edit(Request $request,$id){
//        if(Auth::user()->hasRole('administrator') or Auth::user()->id == $id) {
//        if (Auth::user()->hasRole('administrator')) {
            if (true) {
            if (filter_var($id, FILTER_VALIDATE_INT)) {
                $user = User::find($id);
                if ($user) {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required|max:255|min:1',
                        'family' => 'required|max:255|min:1',
                        'image' => 'required|max:255|min:1',
                        'role' => 'required|max:255|min:1',
                        'about' => 'required|max:255|min:1',
                        'email' => 'email|max:255|min:1',
                    ]);
                    if (!$validator->fails()) {
//        if (Auth::user()->hasRole('administrator')) {
                        if (true) {
                            $role = Role::where('name', '=', $request->get('role'))->get();
                            if (!$role) {
                                return redirect()->back()->withInput()->with(["error" => "Selected Role Is Invalid."]);
                            }
                        }
                        $user->name = trim($request->get('name'));
                        $user->family = trim($request->get('family'));
                        $user->email = trim($request->get('email'));
                        $user->image = trim($request->get('image'));
                        $user->about = trim($request->get('about'));
                        if ($user->save()) {
//        if (Auth::user()->hasRole('administrator')) {
                            if (true) {
                                Role_User::where('user_id', '=', $id)->delete();
                                $user_role = new Role_User();
                                $user_role->role_id = $role[0]->id;
                                $user_role->user_id = $user->id;
                                $user_role->save();
                            }
                            return redirect()->back()->withInput()->with(["success" => "Update Completed Successfully."]);
                        } else {
                            return redirect()->back()->withInput()->with(["error" => "Update Failed."]);
                        }
                    } else {
                        return redirect()->back()->withInput()->with(["error" => "Complete the form correctly."]);
                    }
                } else {
                    return redirect()->back()->withInput()->with(["error" => "User Not Found!!!."]);
                }
            }
            return redirect()->back()->withInput()->with(["error" => "Error, Try Again Later."]);
        }else {
            return view('errors.403');
        }
    }

    public function edit_password(Request $request, $id){
//        if(Auth::user()->hasRole('administrator') or Auth::user()->id == $id) {
//        if (Auth::user()->hasRole('administrator')) {
            if (true) {
            if (filter_var($id, FILTER_VALIDATE_INT)) {
                $user = User::find($id);
                if ($user) {
                    $validator = Validator::make($request->all(), [
                        'password' => 'required|max:255|min:8',
                        'ppassword' => 'required|max:255|min:8',
                    ]);
                    if (!$validator->fails() and trim($request->get('password')) == trim($request->get('ppassword'))) {
                        $user->password = Hash::make(trim($request->get('password')));
                        if ($user->save()) {
                            return redirect()->back()->withInput()->with(["psuccess" => "Password Changed."]);
                        } else {
                            return redirect()->back()->withInput()->with(["perror" => "Update Failed."]);
                        }
                    } else {
                        return redirect()->back()->withInput()->with(["perror" => "Form Input Is Invalid,Password Must Be More Than 8 Characters Long."]);
                    }
                } else {
                    return redirect()->back()->withInput()->with(["perror" => "User Not Found!!!."]);
                }
            }
            return redirect()->back()->withInput()->with(["perror" => "Error, Try Again Later."]);
        }else {
            return view('errors.403');
        }
    }

    public function create(Request $request){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $data = array();

            return view('panel.users_create', compact('data'));
        }else {
            return view('errors.403');
        }
    }

    public function store(Request $request){
//        if (Auth::user()->hasRole('administrator')) {
        if (true) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:1',
                'family' => 'required|max:255|min:1',
                'email' => 'email|max:255|min:4|unique:users',
                'image' => 'required|min:1',
                'role' => 'required|min:1',
                'about' => 'required|min:1',
                'password' => 'required|max:255|min:8',
                'ppassword' => 'required|max:255|min:8',
            ]);
            if (!$validator->fails()) {
                if (trim($request->get('password')) == trim($request->get('ppassword'))) {
                    $role = Role::where('name', '=', $request->get('role'))->get();
                    if(!$role){
                        return redirect()->back()->withInput()->with(["error" => "Selected Role Is Invalid."]);
                    }
                    $user = new User();
                    $user->name = trim($request->get('name'));
                    $user->family = trim($request->get('family'));
                    $user->image = trim($request->get('image'));
                    $user->email = trim($request->get('email'));
                    $user->about = trim($request->get('about'));
                    $user->password = Hash::make(trim($request->get('password')));
                    if ($user->save()) {
                        $user_role = new Role_User();
                        $user_role->role_id = $role[0]->id;
                        $user_role->user_id = $user->id;
                        $user_role->save();
                        return redirect()->back()->withInput()->with(["success" => "Users Created."]);
                    } else {
                        return redirect()->back()->withInput()->with(["error" => "Failed To Save User."]);
                    }
                } else {
                    return redirect()->back()->withInput()->with(["error" => "The Confirm Password Confirmation Does Not Match."]);
                }
            } else {
                return redirect()->back()->withInput()->with(["error" => "Form Input Is Invalid, Check Your Email And Password."]);
            }
        }else {
            return view('errors.403');
        }
    }
}
