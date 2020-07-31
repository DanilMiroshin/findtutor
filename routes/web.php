<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

Route::get('/', 'MainPageController');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index');
    Route::patch('/block/{id}', 'AdminController@block');
    Route::patch('/unBlock/{id}', 'AdminController@unBlock');
    Route::patch('/approved/{id}', 'AdminController@approved');
    Route::patch('/unApproved/{id}', 'AdminController@unApproved');
});

Route::group(['prefix' => 'user/', 'middleware' => 'can:update,user'], function () {
    Route::get('{user}/settings', 'UserController@index');    
    Route::post('update/{user}', 'UserController@update');
    Route::delete('delete/{user}', 'UserController@destroy');   
});

Route::patch('teacher/update/{user}', 'TeacherController')->middleware('can:update,user');
Route::get('search', 'SearchController@index');
Route::get('/search/find', 'SearchController@find');

Route::prefix('lesson/')->group(function () {
    Route::post('update/{lesson}', 'LessonsController@update');
    Route::post('create', 'LessonsController@create');
    Route::delete('destroy/{lesson}', 'LessonsController@destroy');
    Route::post('markNotifications', 'LessonsController@markNotifications');
});



