<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Core;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Core
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
        $this->getCart();
        if (!$product = $this->productRepository->getBySlug($slug)) {
            //return redirect()->view('errors.404', $this->data, 404);
            abort(404);
        }
        $this->data['product'] = $product;
        return view('shop.product', $this->data);
    }

    /**
     * Favorite
     * @return Factory|View
     */
    public function favorite()
    {
        $this->getCart();
        return view('shop.favorite', $this->data)->with('info', __('IsEmptyFavoriteMessage'));
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
