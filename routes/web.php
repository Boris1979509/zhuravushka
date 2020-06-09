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
/* home */
Route::get('/', 'HomeController@index')->name('home');

Route::group([
    'namespace' => 'Blog',
    'prefix' => 'page',
], static function () {
    Route::get('sovety', 'BlogController@index')->name('blog');
    //Route::get('/blog/{postSlug}', 'PostController@index')->name('post');
});

/* Pages */
Route::get('page/{pageSlug}/{productId?}', 'PageController@page')->name('page');
