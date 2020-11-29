<?php
use App\Post;
use App\Subject;
use App\Tag;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('posts', 'PostController');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return view('hello-world');
});

Route::get('/test', function(){
    return trans('auth.failed');
});

Route::get('/test2', function(){
    return hello();
});


Route::get('/child', function () {
    return view('child');
});

Route::get('/display-data', function () {
    return view('displayData',['data' => "\x8F!!!test data"]);
});

Route::get('/inspire', 'InspiringController@inspire');

Route::get('/find-subject-1', function(){
    return Subject::find(1)->posts;
});

Route::get('/insert-tags-default-data', function(){
    $tags = [];
    for($i = 0; $i < 3; $i++){
        $tag = new Tag();
        $tag->content = $i . $i . $i;
        array_push($tags, $tag);
    };
    array_map(function($tag) {
        $tag->save();
    }, $tags);
    return 'success';
});

Route::get('/show-all-tag', function(){
    return Tag::all();
});

Route::get('/show-tag-post', function(){
    return Tag::find(1)->posts;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

