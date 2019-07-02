<?php

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

Route::get('home', 'Client\TodoListsController@viewAllLists')->name('home')->middleware('auth');

Route::get('/', function () {
   return view('index');
})->name('welcome')->middleware('check.login');

//Auth::routes();
Route::get('login', function () {
   return view('login');
})->name('login')->middleware('check.login');

Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', function () {
    return view('register');
})->name('register')->middleware('check.login');

Route::post('register', 'Auth\RegisterController@register');


Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('create_list', 'Client\TodoListsController@createList')->name('create_list')->middleware('auth');

Route::get('public_list', 'Client\TodoListsController@changeIsPublicList')->name('public.list');

Route::get('private_list', 'Client\TodoListsController@changeIsPublicList')->name('private.list');

Route::post('delete_list', 'Client\TodoListsController@deleteList')->name('delete.list')->middleware('private.list');

Route::get('board/{code}', 'Client\TodoListsController@viewList')->name('link.board')->middleware('private.list');

Route::post('share_list', 'Client\AccessesController@createShare')->name('share.list')->middleware('private.list');

Route::post('content_swapPosition', 'Client\TasksController@swapPosition')->name('content_swapPosition');

Route::post('create_task', 'Client\TasksController@createTask')->name('create_task')->middleware('private.list');

Route::get('searchList', 'Client\TodoListsController@searchList')->name('searchList');

Route::get('searchTask', 'Client\TasksController@searchTask')->name('searchTask');

Route::post('edit_task', 'Client\TasksController@editTask')->name('edit.task');

Route::post('delete_task', 'Client\TasksController@deleteTask')->name('delete.task');

Route::post('delete_user', 'Client\UsersController@deleteUser')->name('delete.user');

Route::get('profile', 'Client\UsersController@profileUser')->name('profile');

Route::group(['prefix' => 'admin'], function () {
    Route::get('list', 'Client\TodoListsController@manageList')->name('admin.list');
    Route::get('user', 'Client\UsersController@manageUser')->name('admin.user');
});

Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider')->name('facebook.login') ;

Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');
