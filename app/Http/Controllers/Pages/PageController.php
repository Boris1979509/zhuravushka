<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Core;
use App\Repositories\UserRepository;
use App\UseCases\Cart\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\UseCases\Products\PriceService;

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
    /**
     * @var PriceService $service
     */
    private $service;

    public function __construct(PriceService $service)
    {
        parent::__construct();
        $this->service = $service;
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
        $this->data['products'] = $this->service->subtractPercent($this->productRepository->getAllProducts());
        $this->data['homePageTop'] = $this->productCategoryRepository->getHomePageTop();
    }

    /**
     * @param CartService $cartService
     * @return Factory|View|void
     */
    public function index(CartService $cartService)
    {
        $page = $this->pageRepository->getFirstPage(self::HOME_PAGE_NAME);
        if (!$page) {
            return abort(404);
        }
        $this->data['page'] = $page;
        return view('pages.home', $this->data, $cartService->getCart());
    }

    /**
     * @param string $slug
     * @param CartService $cartService
     * @return Factory|View|void
     */
    public function page(string $slug, CartService $cartService)
    {
        $page = $this->pageRepository->getFirstPageBySlug($slug);
        if (!$page) {
            return abort(404);
        }

        $this->data['page'] = $page;
        $this->data['pagesNavMenu'] = $this->data['pages']->where('parent_id', 0);
        $this->data['subPage'] = ($page->children) ? $page->children->first() : $page->parent->children->first();
        return view('page', $this->data, $cartService->getCart());
    }
}
