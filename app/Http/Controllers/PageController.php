<?php

namespace App\Http\Controllers;

use App\Models\Shop\Page;
use App\Models\Shop\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @param Request $request
     * @param string $pageSlug
     * @param string $childPageSlug
     * @return Factory|View
     */
    public function page(Request $request, $pageSlug, $childPageSlug = null): view
    {
        $page = $this->getPage($pageSlug);
        $page->viewName = 'dostavka-i-oplata'; // Page uslugi

        $pages = Page::all(); // All pages
        $pagesNav = Page::where('parent_id', 0)->orderBy('id')->get();

        // Children
        $children = $page->children;
        // Parent
        // $parent = $page->parent;

        if ($childPageSlug) {
            $page = $this->getPage($childPageSlug);
            $page->slug = $page->parent->slug;

            $page->viewName = $childPageSlug;
            $children = $page->parent->children;
        }

        $shopCategory = ShopCategory::all(); // All categories
        return view('page', compact('page', 'pages', 'shopCategory', 'pagesNav', 'children'));
    }

    /**
     * @param string $slug
     * @return mixed
     */
    private function getPage($slug)
    {
        return Page::where('slug', $slug)->firstOrFail();
    }
}
