<?php

namespace App\Http\Controllers;

use App\Models\Shop\Page;
use App\Models\Shop\ShopCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @param string $pageSlug
     * @return Factory|View
     */
    public function page(string $pageSlug): view
    {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        $pages = Page::all(); // All pages
        $shopCategory = ShopCategory::all(); // All categories
        return view('pages.page', compact('page', 'pages', 'shopCategory'));
    }
}
