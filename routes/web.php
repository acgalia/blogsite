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

Route::get('/menu', function () {
    return view('/users.menu');
   
});

Route::get('/menu', 'UserController@showBlog');
Route::post('/addblog', 'UserController@saveBlog');
Route::delete('/menu/{id}/delete', 'UserController@deleteBlog');
Route::patch('/menu/{id}/edit', 'UserController@editBlog');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
