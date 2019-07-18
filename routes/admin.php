<?php
//admin route here
Route::group(['prefix' => 'admin'], function () {

    Route::get('list', 'Client\TodoListsController@manageList')->name('admin.list')->middleware('admin');

    Route::get('user', 'Client\UsersController@manageUser')->name('admin.user')->middleware('admin');

    Route::get('toggleVip', 'Client\UsersController@toggleVip')->name('toggle.vip')->middleware('admin');
});
