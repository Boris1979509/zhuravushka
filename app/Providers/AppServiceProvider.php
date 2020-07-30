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
        View::composer(['components.header', 'shop.favorite', 'shop.compare'], static function ($view) {
            /**
             * Favorite
             */
            $favorite = app(\App\UseCases\Products\FavoriteService::class)
                ->getUserFavoriteList();
            if ($favoriteCount = $favorite) {
                $favoriteCount = $favorite->count();
            } else {
                $favoriteCount = 0;
            }
            /**
             * Compare
             */
            $compare = app(\App\UseCases\Products\CompareService::class)
                ->getUserCompareList();
            if ($compareCount = $compare) {
                $compareCount = $compare->count();
            } else {
                $compareCount = 0;
            }
            $view->with(compact('favorite', 'favoriteCount', 'compare', 'compareCount'));
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
