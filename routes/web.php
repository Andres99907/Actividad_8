<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
 

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

Route::get('/courses', 'App\Http\Controllers\CoursesController@index')->name('courses.index');
Route::get('/courses/create', 'App\Http\Controllers\CoursesController@create')->name('courses.create');
Route::post('/courses', 'App\Http\Controllers\CoursesController@store')->name('courses.store');
Route::get('/courses/{course}', 'App\Http\Controllers\CoursesController@show')->name('courses.show');
Route::delete('/courses/{ID}', 'App\Http\Controllers\CoursesController@destroy')->name('courses.destroy');
Route::put('courses/{course}', 'App\Http\Controllers\CoursesController@update')->name('courses.update');

Route::get('/', function () {
    return view('courses');
});
