<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Core;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Models\Shop\Product;
use Illuminate\View\View;
use App\UseCases\products\PriceService;

class ProductController extends Core
{
    /**
     * @var array $data
     */
    protected $data = [];
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
        $this->data['products'] = $this->productRepository->getAllProducts();

    }

    /**
     * @param $slug
     * @return Factory|View
     */
    public function index($slug)
    {
        $this->getCart();
        /**
         * @var Product $product
         */
        if (!$product = $this->productRepository->getBySlug($slug)) {
            return abort(404);
        }
        $this->data['product'] = $product;
        $this->data['product']['old_price'] = $this->service->subtractPercent($product->price);
        return view('shop.product', $this->data);
    }

    /**
     * Compare
     * @return Factory|View
     */
    public function compare()
    {
        $this->getCart();
        return view('shop.compare', $this->data)->with('info', __('IsEmptyCompareMessage'));
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
