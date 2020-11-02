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

Route::get('/', 'Frontend\Settings\UserController@index')->name('/');
Route::get('/home', 'Frontend\Settings\UserController@index')->name('home');

Route::get('/beranda', 'Frontend\Settings\UserController@beranda')->name('beranda');
Route::get('/tentang/{slug}', 'Frontend\Settings\UserController@about')->name('tentang');
//Route::get('/hubungi/{slug}', 'Frontend\Settings\UserController@contact')->name('hubungi');
Route::get('/konten-detail/{id}', 'Frontend\Settings\UserController@detail')->name('konten-detail');


//Route::post('/save-token', 'Backend\Settings\UserController@save_token')->name('save-token');
Route::post('/save-token')->middleware('oreno.auth')->name('oreno.auth');
Route::get('/logout', 'Frontend\Settings\UserController@logout')->name('logout');