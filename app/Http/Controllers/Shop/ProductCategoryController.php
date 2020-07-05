<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCategoryController extends BaseController
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
    }

    /**
     * Show all catalog
     * @return View
     */
    public function index(): View
    {
        $this->getCart();
        return view('shop.catalog', $this->data);
    }

    /**
     * @param $slug
     * @return RedirectResponse|view
     */
    public function category($slug)
    {

        $this->data['category'] = $this->productCategoryRepository->getBySlug($slug);

        if (is_null($this->data['category'])) {
            return redirect()->route('catalog');
        }
        $this->getCart();
        return view('shop.category', $this->data);
    }

    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }
}
