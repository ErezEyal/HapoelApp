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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::redirect('/', '/home');
Route::get('/home', 'MainController@showHome');
//Route::get('/standings', 'TableController@show');
//Route::get('/news', 'MainController@showNews');
//Route::get('/matches', 'MainController@showMatches');
Route::get('/all-articles', 'MainController@allArticles');
Route::get('/loading', 'MainController@loading');
