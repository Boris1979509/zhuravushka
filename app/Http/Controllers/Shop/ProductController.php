<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends BaseController
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
     * @param $slug
     * @return Factory|View
     */
    public function index($slug)
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = $this->data['order']->cartCount();
        $this->data['product'] = $this->productRepository->getBySlug($slug);
        return view('shop.product', $this->data);
    }
}
