<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodeine\Acl\Models\Eloquent\Permission;
use Kodeine\Acl\Models\Eloquent\Role;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

#########################################################################3
        # Role

//        $roleAdmin = new Role();
//        $roleAdmin->name = 'Administjrator';
//        $roleAdmin->slug = 'administratorl';
//        $roleAdmin->description = 'manage administration privileges';
//        $roleAdmin->save();
//


        $user = User::first(); # User::find('administrator ');
        // $user->assignRole(1);

        // $user->revokeRole(1);
        // $user->syncRoles([1]);
        // $user->revokeAllRoles();
//        print_r($user->getRoles());
#########################################################################3
        #permission
//        $permission = new Permission();
//        $permUser = $permission->create([
//            'name'        => 'user',// a tabel
//            'slug'        => [          // pass an array of permissions.
//                'create'     => true,
//                'view'       => true,
//                'update'     => true,
//                'delete'     => true
//            ],
//            'description' => 'manage user permissions'
//        ]);

        $roleAdmin = Role::first();
        // $roleAdmin->assignPermission('user'); // permission name or id
        // $roleAdmin->assignPermission(Permission::all());

        // $roleAdmin->revokePermission('user');
        // $roleAdmin->revokePermission(Permission::all());
#########################################################################3
        // create.user, view.user, update.user, delete.user
        // returns false if alias exists.
        // $user->addPermission('user');
        // $user->addPermission('update.user', true);
        // $user->addPermission('view.phone.user', true);
        // $user->addPermission('user', [
        //      'view.phone' => true,
        //      'view.blog' => false
        // ]);
        // $user->removePermission('user');
#########################################################################3
#########################################################################3

#Permissions Inheritance

        //  $roleTeacher = Role::create([
        //     'name'        => 'Teacher',
        //     'slug'        => 'teacher',
        //     'description' => 'Teacher [...]'
        // ]);

        // $roleStudent = Role::create([
        //     'name'        => 'Student',
        //     'slug'        => 'student',
        //     'description' => 'Student [...]'
        // // ]);
//         $permissionInternship = Permission::create([
//             'name'        => 'internships',
//             'slug'        => [ // an array of permissions.
//                 'create' => true,
//                 'view'   => true,
//                 'update' => true,
//                 'delete' => true,
//             ],
//             'description' => 'manage internships'
//         ]);

        // $permissionStudent = Permission::create([
        //     'name'        => 'internships.student',
        //     'slug'        => [ // an array of permissions only for student
        //         'create' => false,
        //     ],
        //     // we use permission inheriting.
        //     'inherit_id' => $permissionInternship->getKey(),
        //     'description' => 'student internship permissions'
        // ]);


$user = User::first();
//$user->hasRole('administrator');
//        $data = array();
//        $data['roles'] = Role::all()->toArray();
//
//        print_r($data);
        $r = $user->getPermissions();
        print_r($r);
//         return view('home');
    }
}
