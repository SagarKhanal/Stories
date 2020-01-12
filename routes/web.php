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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/admin', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin','auth']], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
    Route::get('/add-roles', 'Admin\DashBoardController@registered');
    Route::get('/pages', 'Admin\PagesController@pages');
    Route::get('/role-edit/{id}','Admin\DashBoardController@editUser');
    Route::delete('/role-delete/{id}','Admin\DashBoardController@deleteUser');
    Route::put('/update-role/{id}','Admin\DashBoardController@updateRole' );
    Route::post('/add-story','Admin\PagesController@addStory' );
    Route::post('/edit-story/{id}','Admin\PagesController@updateStory' );
    Route::get('/pages/{id}','Admin\PagesController@editStory');
    Route::delete('/delete-story/{id}','Admin\PagesController@deleteStory');
});
