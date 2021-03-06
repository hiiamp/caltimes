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
Route::get('/', function () {
   return view('index');
})->name('welcome')->middleware('check.login');

Route::get('login', function () {
   return view('login');
})->name('login')->middleware('check.login');

Route::get('register', function () {
    return view('register');
})->name('register')->middleware('check.login');

Route::group(['namespace' => 'Auth'], function() {

    Route::post('register', 'RegisterController@register');

    Route::get('user/activation/{token}', 'RegisterController@activateUser')->name('user.activate');

    Route::get('auth/facebook', 'LoginController@redirectToProvider')->name('facebook.login') ;

    Route::get('auth/facebook/callback', 'LoginController@handleProviderCallback');

    Route::post('login', 'LoginController@login');

    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'Client'], function() {

    Route::get('changePassword','UsersController@changePassword')->name('changePassword')->middleware('auth');

    Route::get('resetPassword','UsersController@resetPassword')->name('resetPass');

    Route::get('checkEmail','UsersController@checkEmail')->name('checkEmail');

    Route::post('sendTokenResetPass', 'UsersController@sendTokenResetPass')->name('sendTokenResetPass');

    Route::get('user/resetPass/{token}', 'UsersController@tokenResetPass')->name('user.resetPassToken');

    Route::get('home', 'TodoListsController@viewAllLists')->name('home')->middleware('auth');

    Route::get('searchUser', 'UsersController@searchUser')->name('searchUser');

    Route::get('toggleMyCoWorker', 'CoworkersController@toggleCoWorker')->name('toggleCoWorker');

    Route::get('toggleShareList', 'AccessesController@toggleShareList')->name('toggleShareList');

    Route::post('create_list', 'TodoListsController@createList')->name('create_list')->middleware('auth');

    Route::get('public_list', 'TodoListsController@changeIsPublicList')->name('public.list');

    Route::get('private_list', 'TodoListsController@changeIsPublicList')->name('private.list');

    Route::post('delete_list', 'TodoListsController@deleteList')->name('delete.list')->middleware('private.list');

    Route::post('recycle_list', 'TodoListsController@moveListToRecycle')->name('recycle.list')->middleware('private.list');

    Route::get('board/{code}', 'TodoListsController@viewList')->name('link.board')->middleware('private.list');

    Route::get('recover/{code}', 'TodoListsController@recoverList')->name('list.recover')->middleware('private.list');

    Route::post('share_list', 'AccessesController@createShare')->name('share.list')->middleware('private.list');

    Route::post('content_swapPosition', 'TasksController@swapPosition')->name('content_swapPosition');

    Route::get('create_task', 'TasksController@createTask')->name('create_task');

    Route::get('searchList', 'TodoListsController@searchList')->name('searchList');

    Route::get('recover/{code}', 'TodoListsController@recoverList')->name('list.recover');

    Route::get('searchTask', 'TasksController@searchTask')->name('searchTask');

    Route::get('edit_task', 'TasksController@editTask')->name('edit.task')->middleware('private.list');

    Route::get('delete_task', 'TasksController@deleteTask')->name('delete.task');

    Route::post('outList', 'AccessesController@outList')->name('out.list');

    Route::post('delete_user', 'UsersController@deleteUser')->name('delete.user')->middleware('admin');

    Route::get('profile', function () {
        return view('user.profile.index');
    })->name('profile')->middleware('auth');

    Route::get('profile/worker', 'UsersController@profileUser')->name('worker')->middleware('auth');

    Route::get('profile/recycle', 'UsersController@recycleList')->name('recycle')->middleware('auth');

    Route::get('profile/favorite', 'UsersController@favoriteUser')->name('favorite')->middleware('auth');

    Route::get('maskAsRead', 'TodoListsController@maskRead')->name('maskRead');

    Route::get('delete_noti', 'TodoListsController@deleteNoti')->name('delete_noti');

    Route::get('export', 'TasksController@export_csv')->name('export');
});

Route::get('searchUser', 'Client\UsersController@searchUser')->name('searchUser');

Route::get('notification', function () {
    return view('user.notification.index');
})->name('notification')->middleware('auth');

Route::get('test', function () {
    return view('auth.passwords.reset');
});

Route::get('abc', function () {
    return view('user.profile.recycle');
})->name('abc');