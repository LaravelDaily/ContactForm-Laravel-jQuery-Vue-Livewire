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

Route::redirect('/home', '/');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/submit', 'HomeController@submit')->name('submit');

Route::post('/contact', 'HomeController@postContact')->name('contact');
