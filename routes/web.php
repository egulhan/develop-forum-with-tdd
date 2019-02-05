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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

// threads
Route::get('/threads/{channel?}','ThreadsController@index')->name('threads.index');
Route::post('/threads/{thread}/replies', 'RepliesController@store')->name('replies.store');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::resource('threads', 'ThreadsController')->only([
    'create', 'store', 'edit', 'update', 'destroy'
]);
