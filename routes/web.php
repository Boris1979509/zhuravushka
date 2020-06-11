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
], static function () {
    Route::get('page/sovety', 'BlogController@index')->name('page.blog');
    Route::get('blog/post/{postSlug}', 'PostController@index')->name('blog.post');
    Route::get('blog/category/{CategorySlug}', 'BlogController@getByCategory')->name('blog.category');
});

/* Pages */
Route::get('page/{pageSlug}/{productId?}', 'PageController@page')->name('page');
