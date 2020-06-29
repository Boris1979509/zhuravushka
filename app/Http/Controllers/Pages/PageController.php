<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PageController extends BaseController
{
    /**
     * @var array $data
     */
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
        $this->data['products'] = $this->productRepository->getAllProducts();
    }

    /**
     * @return View | redirect
     */
    public function index()
    {
        $this->getCart();

        $page = $this->pageRepository->homePage();
        $this->data['page'] = $page;
        return view('pages.home', $this->data);
    }

    /**
     * @param string $slug
     * @return Factory|View
     */
    public function page(string $slug)
    {
        $this->getCart();
        $page = $this->pageRepository->getPageFirstBySlug($slug);
        $this->data['page'] = $page;
        return view("pages.{$page->page}", $this->data);
    }

    /**
     * @param null $slug
     * @return View
     */
    public function services($slug = null): view
    {
        $this->getCart();
        $page = $this->pageRepository->getPageFirstBySlug('uslugi');
        $this->data['page'] = $page;
        $this->data['children'] = $page->children;
        $this->data['subPage'] = $page->children[0]->page; // Default load subPage

        if ($slug) {
            $page = $this->pageRepository->getPageFirstBySlug($slug);
            $this->data['page'] = $page;
            $this->data['subPage'] = $page->page;
        }
        return view('pages.services', $this->data);
    }

    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }
}
