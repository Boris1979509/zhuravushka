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
Route::group([
    'namespace' => 'Pages',
], static function () {
    Route::get('/', 'PageController@index')->name('home');
    Route::group([
        'prefix' => 'page',
    ], static function () {
        Route::get('/uslugi/{slug?}', 'PageController@services')->name('page.service');
        Route::get('/{slug}', 'PageController@page');
    });
});


Route::group([
    'namespace' => 'Blog',
], static function () {
    Route::get('blog', 'BlogController@index')->name('blog');
    Route::group([
        'prefix' => 'blog',
        'as'     => 'blog.',
    ], static function () {
        Route::get('post/{postSlug}', 'PostController@index')->name('post');
        Route::get('category/{CategorySlug}', 'BlogController@getByCategory')->name('category');
    });

});
