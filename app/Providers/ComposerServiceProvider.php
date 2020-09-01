<?php

namespace App\Providers;

use App\Http\ViewComposers\ComparesComposer;
use App\Http\ViewComposers\FavoritesComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'components.sub-header-navbar',
            'shop.cardIconFavorite',
            'shop.favorite',
        ], FavoritesComposer::class);
        view()->composer([
            'components.sub-header-navbar',
            'shop.cardIconCompare',
            'shop.compare'
        ], ComparesComposer::class);
    }
}
