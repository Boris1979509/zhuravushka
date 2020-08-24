<?php

namespace App\Providers;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Observers\BlogCategoryObserver;
use App\Observers\BlogPostObserver;
use App\Repositories\OrderRepository;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Support\ServiceProvider;
use View;
use Jenssegers\Date\Date;
use App\Repositories\PageRepository;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer([
            'components.header',
            'components.sub-header-navbar',
            'shop.cardIconFavorite',
            'shop.cardIconCompare',
            'shop.favorite',
            'shop.compare'
        ], static function ($view) {
            /**
             * Favorite
             */
            $favorites = app(\App\UseCases\Products\FavoriteService::class)
                ->getUserFavoriteList();
            if ($favoriteCount = $favorites) {
                $favoriteCount = $favorites->count();
            } else {
                $favoriteCount = 0;
            }
            /**
             * Compare
             */
            $compares = app(\App\UseCases\Products\CompareService::class)
                ->getUserCompareList();
            if ($compareCount = $compares) {
                $compareCount = $compares->count();
            } else {
                $compareCount = 0;
            }
            $view->with(compact('favorites', 'favoriteCount', 'compares', 'compareCount'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Date::setlocale(config('app.locale'));
        BlogPost::observe(BlogPostObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
    }
}
