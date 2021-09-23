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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/************************              admin panel request              ************************/
Route::get('admin/', 'Auth\AdminLoginController@showLoginForm')->name('adminLoginForm');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('adminLogin');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('adminLogout');

Route::group(['middleware' => ['web', 'admin.auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin-dashboard');
});
/************************              end admin panel request              ************************/




/************************              provider panel request              ************************/
Route::group(['middleware' => ['web', 'provider.auth:provider'], 'prefix' => 'provider'], function () {
    Route::get('dashboard', function () {
        return view('provider.dashboard');
    })->name('provider-dashboard');
});
