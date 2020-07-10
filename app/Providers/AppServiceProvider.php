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
        View::composer(['components.header', 'components.footer', 'components.barMenu', 'components.pageNavMenu'], static function ($view) {

//            $pages = (new PageRepository)->getAllPagesNav();
//            $productCategories = app(ProductCategoryRepository::class)->getAllProductCategories();
//            $order = app(OrderRepository::class)->findByOrderId(session('orderId'));
//            $cartCount = ($order) ? $order->cartCount() : null;
//            $view->with(compact('pages', 'productCategories', 'order', 'cartCount'));
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
