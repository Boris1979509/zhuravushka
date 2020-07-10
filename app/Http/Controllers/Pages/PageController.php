<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Core;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PageController extends Core
{
    /**
     * @var array $data
     */
    protected $data = [];
    /**
     * Home page
     */
    public const HOME_PAGE_NAME = 'home';

    public function __construct()
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
        $this->data['products'] = $this->productRepository->getAllProducts();
        $this->data['homePageTop'] = $this->productCategoryRepository->getHomePageTop();
    }

    /**
     * @return View | redirect
     */
    public function index()
    {
        $this->getCart();
        $this->data['page'] = $this->data['pages']->where('page', self::HOME_PAGE_NAME)->first();
        return view('pages.home', $this->data);
    }

    /**
     * @param string $slug
     * @return Factory|View
     */
    public function page(string $slug)
    {
        if (!$this->pageRepository->getPageFirstBySlug($slug)) {
            return abort(404);
        }
        $page = $this->data['pages']->where('slug', $slug)->first();

        $this->data['page'] = $page;
        $this->data['pagesNavMenu'] = $this->data['pages']->where('parent_id', 0);
        $this->data['subPage'] = ($page->children) ? $page->children->first() : $page->parent->children->first();
        $this->getCart();
        return view('page', $this->data);
    }

    /**
     * Cart
     */
    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }
}
