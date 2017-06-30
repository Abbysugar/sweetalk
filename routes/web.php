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
    return view('auth.login');
});


Route::get('/home', 'PostController@getPost')->name('home');

Auth::routes();

Route::post('/createpost', 'PostController@createPost');

Route::get('/profile', 'PostController@getProfile')->name('profile');

Route::post('/saveprofile', 'PostController@saveProfile')->name('saveprofile');

Route::get('/userimage/{filename}', 'PostController@userImage')->name('userimage');

Route::get('/editpost/{post_id}', 'PostController@editPost')->name('editpost');

Route::post('/updatepost/{post_id}', 'PostController@updatePost')->name('updatepost');

Route::get('/deletepost/{post_id}', 'PostController@deletePost')->name('deletepost');

Route::get('/likepost/{post_id}', 'PostController@like')->name('likepost');

Route::post('/comment/{id}', 'PostController@comment')->name('postcomment');
