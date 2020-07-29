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
             * Favorite count
             */
            $favoriteCount = app(\App\UseCases\Products\FavoriteService::class)
                ->count();
            /**
             * Compare count
             */
            $compareCount = app(\App\UseCases\Products\CompareService::class)
                ->count();
            $view->with(compact('favoriteCount', 'compareCount'));
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
