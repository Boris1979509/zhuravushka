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
        //Route::get('/uslugi/{slug?}', 'PageController@services')->name('page.service');
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
    Route::get('category', 'ProductCategoryController@index')->name('catalog');
    Route::get('category/{categorySlug}', 'ProductCategoryController@category')->name('category');
    Route::get('product/{slug}', 'ProductController@index')->name('product');
    Route::get('favorites', 'FavoriteController@index')->name('favorite.index');
    Route::post('favorite/{product}', 'FavoriteController@add')->name('favorite.add');
    Route::delete('favorite/{product}', 'FavoriteController@remove')->name('favorite.remove');
    Route::get('compare', 'ProductController@compare')->name('compare');
    Route::group([
        'as'     => 'cart.',
        'prefix' => 'cart',
    ], static function () {
        Route::post('add/{id}', 'CartController@add')->name('add');
        Route::post('remove/{id}', 'CartController@remove')->name('remove');
    });
});
// Order
Route::group([
    'namespace' => 'Order',
    'prefix'    => 'order',
    'as'        => 'order.',
], static function () {
    Route::get('place', 'OrderController@place')->name('place');
    Route::post('confirm', 'OrderController@confirm')->name('confirm');
    Route::get('info', 'OrderController@info')->name('info');
});

Auth::routes(['login' => false]); // except route

// User Cabinet
Route::group([
    'namespace'  => 'Cabinet',
    'prefix'     => 'cabinet',
    'as'         => 'cabinet.',
    'middleware' => 'auth',
], static function () {
    Route::get('/', 'HomeController@index')->name('home');
    /* Profile */
    Route::get('/home', 'ProfileController@index')->name('profile.home');
    Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/update', 'ProfileController@update')->name('profile.update');
    /* End Profile */
    Route::get('/favorite', 'FavoriteController@index')->name('favorite');
    Route::get('/feedback', 'FeedbackController@index')->name('feedback');
    Route::get('/comment', 'CommentController@index')->name('comment');
    Route::get('/order', 'OrderController@index')->name('order');
});
// Phone register verify
Route::group(['namespace' => 'Auth',], static function () {
    Route::post('/phone', 'PhoneController@request')->name('phone.request');
    Route::post('/verify', 'PhoneController@verify')->name('phone.verify');
    Route::post('/login', 'LoginController@login')->name('login');
});


