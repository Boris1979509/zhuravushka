<?php

namespace App\Providers;

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
        View::composer(['components.header', 'shop.cardIconFavorite', 'shop.cardIconCompare', 'cabinet.favorite.index', 'shop.compare'], static function ($view) {
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
    }
}
