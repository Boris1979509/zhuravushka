<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Models\Shop\ShopCategory;
use App\Models\Shop\Page;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */

    public function index(): view
    {
        $pages = Page::all();
        $shopCategory = ShopCategory::all();
        return view('home', compact('pages', 'shopCategory'));
    }

}
