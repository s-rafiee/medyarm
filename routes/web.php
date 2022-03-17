<?php

Route::get('/dashboard/logout', [\App\Http\Controllers\DashboardController::class, 'logout']);

Route::group(['prefix' => 'dashboard', "middleware" => ["auth", "auth.lock"]], function () {


    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);


    #########################################################
    /*
        Skills Routes
    */
    Route::get('/skills', [\App\Http\Controllers\SkillsController::class, 'skills']);
    Route::post('/skills/update/active', [\App\Http\Controllers\SkillsController::class, 'changeActive']);
    Route::get('/skills/create', [\App\Http\Controllers\SkillsController::class, 'create']);
    Route::post('/skills/store', [\App\Http\Controllers\SkillsController::class, 'store']);
    Route::post('/skills/delete', [\App\Http\Controllers\SkillsController::class, 'delete']);
    Route::get('/skills/edit/{id}', [\App\Http\Controllers\SkillsController::class, 'edit']);
    Route::post('/skills/edit/{id}', [\App\Http\Controllers\SkillsController::class, 'save_edit']);

    #########################################################
    /*
        Courses Routes
    */
    Route::get('/courses', [\App\Http\Controllers\CoursesController::class, 'courses']);
    Route::post('/courses/update/active', [\App\Http\Controllers\CoursesController::class, 'changeActive']);
    Route::get('/courses/create', [\App\Http\Controllers\CoursesController::class, 'create']);
    Route::post('/courses/store', [\App\Http\Controllers\CoursesController::class, 'store']);
    Route::post('/courses/delete', [\App\Http\Controllers\CoursesController::class, 'delete']);
    Route::get('/courses/edit/{id}', [\App\Http\Controllers\CoursesController::class, 'edit']);
    Route::post('/courses/edit/{id}', [\App\Http\Controllers\CoursesController::class, 'save_edit']);
    Route::post('/courses/search', [\App\Http\Controllers\CoursesController::class, 'search']);


    #########################################################
    /*
        Lessons Routes
    */
    Route::get('/lessons', [\App\Http\Controllers\LessonsController::class, 'lessons']);
    Route::get('/lessons/create', [\App\Http\Controllers\LessonsController::class, 'create']);
    Route::post('/lessons/store', [\App\Http\Controllers\LessonsController::class, 'store']);
    Route::post('/lessons/delete', [\App\Http\Controllers\LessonsController::class, 'delete']);
    Route::post('/lessons/update/active', [\App\Http\Controllers\LessonsController::class, 'changeActive']);
    Route::get('/lessons/edit/{id}', [\App\Http\Controllers\LessonsController::class, 'edit']);
    Route::post('/lessons/edit/{id}', [\App\Http\Controllers\LessonsController::class, 'save_edit']);


    #########################################################
    /*
        Pages Routes
    */
    Route::get('/pages', [\App\Http\Controllers\PageController::class, 'pages']);
    Route::get('/pages/create', [\App\Http\Controllers\PageController::class, 'create']);
    Route::post('/pages/store', [\App\Http\Controllers\PageController::class, 'store']);
    Route::post('/pages/delete', [\App\Http\Controllers\PageController::class, 'delete']);
    Route::post('/pages/update/active', [\App\Http\Controllers\PageController::class, 'changeActive']);
    Route::get('/pages/edit/{id}', [\App\Http\Controllers\PageController::class, 'edit']);
    Route::post('/pages/edit/{id}', [\App\Http\Controllers\PageController::class, 'save_edit']);



    #########################################################
    /*
        Blog Routes
    */
    Route::get('/blogs', [\App\Http\Controllers\BlogsController::class, 'blogs']);
    Route::get('/blogs/create', [\App\Http\Controllers\BlogsController::class, 'create']);
    Route::post('/blogs/store', [\App\Http\Controllers\BlogsController::class, 'store']);
    Route::post('/blogs/delete', [\App\Http\Controllers\BlogsController::class, 'delete']);
    Route::post('/blogs/update/active', [\App\Http\Controllers\BlogsController::class, 'changeActive']);
    Route::get('/blogs/edit/{id}', [\App\Http\Controllers\BlogsController::class, 'edit']);
    Route::post('/blogs/edit/{id}', [\App\Http\Controllers\BlogsController::class, 'save_edit']);


    #########################################################
    /*
        Users Routes
    */
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'users']);
    Route::post('/users/update/active', [\App\Http\Controllers\UserController::class, 'changeActive']);
    Route::post('/users/delete', [\App\Http\Controllers\UserController::class, 'delete']);
    Route::get('/users/edit/{id}', [\App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/users/edit/{id}', [\App\Http\Controllers\UserController::class, 'save_edit']);
    Route::post('/users/edit/{id}/password', [\App\Http\Controllers\UserController::class, 'edit_password']);
    Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create']);
    Route::post('/users/store', [\App\Http\Controllers\UserController::class, 'store']);


    #########################################################
    /*
        Cats Routes
    */
    Route::get('/cats', [\App\Http\Controllers\CatController::class, 'cats']);
    Route::post('/cats/store', [\App\Http\Controllers\CatController::class, 'store']);
    Route::post('/cats/delete', [\App\Http\Controllers\CatController::class, 'delete']);


    #########################################################
    /*
        Developers Routes
    */
//    Route::get('/developers', [\App\Http\Controllers\DevelopersController::class, 'developers']);
//    Route::post('/developers/store', [\App\Http\Controllers\DevelopersController::class, 'store']);
//    Route::post('/developers/delete', [\App\Http\Controllers\DevelopersController::class, 'delete']);
//    Route::post('/developers/update-status', [\App\Http\Controllers\DevelopersController::class, 'update_status']);
//    Route::post('/developers/search', [\App\Http\Controllers\DevelopersController::class, 'search']);


    #########################################################
    /*
        Links Routes
    */
    Route::get('/links/{lesson}', [\App\Http\Controllers\LinksController::class, 'links']);
    Route::post('/links/store', [\App\Http\Controllers\LinksController::class, 'store']);
    Route::post('/links/delete', [\App\Http\Controllers\LinksController::class, 'delete']);

    #########################################################
    /*
        Gallerys Routes
    */
//    Route::get('/gallerys/{post}', [\App\Http\Controllers\GalleryController::class, 'gallery']);
//    Route::post('/gallerys/store', [\App\Http\Controllers\GalleryController::class, 'store']);
//    Route::post('/gallerys/delete', [\App\Http\Controllers\GalleryController::class, 'delete']);

//    Route::post('/cats/update/active','UserController@changeActive');
//    Route::get('/cats/edit/{id}','UserController@edit');
//    Route::post('/cats/edit/{id}','UserController@save_edit');
//    Route::post('/cats/edit/{id}/password','UserController@edit_password');
//    Route::get('/cats/create','UserController@create');


    #########################################################
    /*
        Comments Routes
    */
    Route::get('/comments', [\App\Http\Controllers\CommentController::class, 'comments']);


    #########################################################
    /*
        Medias Routes
    */
    Route::get('/medias/', [\App\Http\Controllers\MediaController::class, 'medias']);


    #########################################################
    /*
        Settings Routes
    */
    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'settings']);
});


#########################################################
/*
    Authenticate Routes
*/
Auth::routes();
Route::get('login/locked', [\App\Http\Controllers\Auth\LoginController::class, 'locked'])->middleware('auth')->name('login.locked');
Route::post('login/locked', [\App\Http\Controllers\Auth\LoginController::class, 'unlock'])->name('login.unlock');


//Template
Route::get('/', [\App\Http\Controllers\TemplateController::class, 'index']);
Route::get('/blog/{id}/{title}', [\App\Http\Controllers\TemplateController::class, 'blog']);
Route::get('/blog', [\App\Http\Controllers\TemplateController::class, 'blogs']);
Route::get('/skills', [\App\Http\Controllers\TemplateController::class, 'skills']);
Route::get('/skill/{skill}', [\App\Http\Controllers\TemplateController::class, 'skill']);
Route::get('/cours/{name}', [\App\Http\Controllers\TemplateController::class, 'cours']);
Route::get('/lesson/{title_en}', [\App\Http\Controllers\TemplateController::class, 'lesson']);


// Route::get('','TheamController@index');
// Route::get('/list/{list}','TheamController@list');
// Route::get('/cats/{cat_name}','TheamController@cats_post');
// Route::post('/comment/create','TheamController@save_comment');
// Route::get('/search','TheamController@search');


Route::get('sitemap.xml', [\App\Http\Controllers\TemplateController::class, 'sitemap']);
Route::get('sitemap/Pages.xml', [\App\Http\Controllers\TemplateController::class, 'sitemap_pages']);
Route::get('sitemap/Skills.xml', [\App\Http\Controllers\TemplateController::class, 'sitemap_Skills']);
Route::get('sitemap/Courses.xml', [\App\Http\Controllers\TemplateController::class, 'sitemap_Courses']);
Route::get('sitemap/Lessons.xml', [\App\Http\Controllers\TemplateController::class, 'sitemap_Lessons']);
Route::get('sitemap/Blogs.xml', [\App\Http\Controllers\TemplateController::class, 'sitemap_Blogs']);

// Route::get('{app_name}','TheamController@on_app');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
?>
