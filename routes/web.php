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
    /* Favorites */
    Route::get('favorite', 'FavoriteController@index')->name('favorite');
    Route::post('favorite/{product}/add', 'FavoriteController@add')->name('favorite.add');
    Route::post('favorite/{product}/remove', 'FavoriteController@remove')->name('favorite.remove');
    /* Compare */
    Route::get('compare', 'CompareController@index')->name('compare');
    Route::post('compare/{product}/add', 'CompareController@add')->name('compare.add');
    Route::post('compare/{product}/remove', 'CompareController@remove')->name('compare.remove');
    Route::group([
        'as'     => 'cart.',
        'prefix' => 'cart',
    ], static function () {
        Route::post('add/{product}', 'CartController@add')->name('add');
        Route::post('remove/{product}', 'CartController@remove')->name('remove');
    });
});
// Order
Route::group([
    'namespace'  => 'Order',
    'prefix'     => 'order',
    'as'         => 'order.',
    'middleware' => 'check_is_not_empty_cart',
], static function () {
    Route::get('place', 'OrderController@place')->name('place');
    Route::post('confirm', 'OrderController@confirm')->name('confirm');
    Route::get('confirm-no-paid', 'OrderController@confirmNoPaid')->name('confirmNoPaid');
    Route::get('confirm-payment', 'OrderController@confirmPayment')->name('confirm.payment');
    Route::get('cancel-payment', 'OrderController@cancelPayment')->name('cancel.payment');
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
    //Route::get('/favorite', 'FavoriteController@index')->name('favorite');
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
// Admin
Route::group([
    'namespace'  => 'Admin',
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['auth', 'can:admin-panel'],
], static function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users', 'UsersController');
});


