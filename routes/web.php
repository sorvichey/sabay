<?php

// Front End
Route::get('/',"FrontController@index");
Route::get('/page/{id}', "FrontPageController@index");
Route::get('/post/category/{id}', "FrontController@category");
Route::get('video/', "FrontController@video");
Route::get('/gift', "FrontController@gift");
Route::get('/post/detail/{id}', "FrontController@detail");
Route::get('/video/detail/{id}', "FrontController@video_detail");
Route::get('/post/{id}', "FrontController@post");
Auth::routes();

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// Back End
Route::get('/admin',"HomeController@index");
Route::get('/admin/dashboard',"HomeController@index");

// load file manager
Route::get('/fm', "FileManagerController@index");
// advertisement
Route::get('/admin/advertisement', "AdvertisementController@index");
Route::get('/admin/advertisement/create', "AdvertisementController@create");
Route::post('/admin/advertisement/save', "AdvertisementController@save");
Route::get('/admin/advertisement/delete/{id}', "AdvertisementController@delete");
Route::get('/admin/advertisement/edit/{id}', "AdvertisementController@edit");
Route::post('/admin/advertisement/update', "AdvertisementController@update");
// gitf 
Route::get('/admin/gift', "GiftController@index");
Route::get('/admin/gift/create', "GiftController@create");
Route::post('/admin/gift/save', "GiftController@save");
Route::get('/admin/gift/delete/{id}', "GiftController@delete");
Route::get('/admin/gift/edit/{id}', "GiftController@edit");
Route::post('/admin/gift/update', "GiftController@update");
// Post
Route::get('/admin/post', "PostController@index");
Route::get('/admin/post/create', "PostController@create");
Route::get('/admin/post/create', "PostController@create");
Route::post('/admin/post/save', "PostController@save");
Route::get('/admin/post/delete/{id}', "PostController@delete");
Route::get('/admin/post/edit/{id}', "PostController@edit");
Route::post('/admin/post/update', "PostController@update");
Route::get('/admin/post/view/{id}', "PostController@view");


// catogory
Route::get('/admin/category', "CategoryController@index");
Route::get('/admin/category/create', "CategoryController@create");
Route::get('/admin/category/edit/{id}', "CategoryController@edit");
Route::get('/admin/category/delete/{id}', "CategoryController@delete");
Route::post('/admin/category/save', "CategoryController@save");
Route::post('/admin/category/update', "CategoryController@update");

// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");

// role
Route::get('/role', "RoleController@index");
Route::get('/role/create', "RoleController@create");
Route::post('/role/save', "RoleController@save");
Route::get('/role/delete/{id}', "RoleController@delete");
Route::get('/role/edit/{id}', "RoleController@edit");
Route::post('/role/update', "RoleController@update");
Route::get('/role/permission/{id}', "PermissionController@index");
Route::post('/rolepermission/save', "PermissionController@save");

Route::get('/home', 'HomeController@index')->name('home');

// Video
Route::get('/admin/video', "VideoController@index");
Route::get('/admin/video/create', "VideoController@create");
Route::post('/admin/video/save', "VideoController@save");
Route::get('/admin/video/edit/{id}', "VideoController@edit");
Route::get('/admin/video/detail/{id}', "VideoController@detail");
Route::post('/admin/video/update', "VideoController@update");
Route::get('/admin/video/delete/{id}', "VideoController@delete");