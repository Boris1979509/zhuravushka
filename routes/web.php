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
        Route::get('/{slug}', 'PageController@page')->name('page');
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
// cart
Route::group([
    'namespace' => 'Shop',
], static function () {
    Route::get('cart', 'CartController@index')->name('cart');
    Route::get('category', 'ProductCategoryController@index')->name('category.main');
    Route::get('category/{categorySlug}', 'ProductCategoryController@category')->name('category');
    Route::get('product/{code}', 'ProductController@index')->name('product');
    Route::group([
        'as'     => 'cart.',
        'prefix' => 'cart',
    ], static function () {
        Route::post('add/{id}', 'CartController@add')->name('add');
    });
});
