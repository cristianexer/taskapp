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

// Route::get('/', function () {
//     return view('welcome');
// });

URL::forceSchema('https');

Auth::routes();

Route::get('/home', 'TaskListController@home');
Route::get('/', 'TaskListController@home');
Route::resource('/taskslist', 'TaskListController');
Route::resource('/tasks', 'TasksController');

Route::get('/{vue_capture?}', function () { return view('app'); })->where('vue_capture', '[\/\w\.-]*');
