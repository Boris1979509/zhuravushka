<?php

namespace App\Http\Controllers\Shop;

use App\UseCases\products\FavoriteService;
use App\Http\Controllers\Core;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Core
{
    /**
     * @var FavoriteService $service
     */
    private $service;
    /**
     * @var array $data
     */
    private $data = [];

    public function __construct(FavoriteService $service)
    {
        parent::__construct();
        //$this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
        $this->getCart();
        return view('shop.favorite', $this->data)->with('info', __('IsEmptyFavoriteMessage'));
    }

    public function add(Product $product)
    {
        try {
            $this->service->add(Auth::id(), $product->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        //return redirect()->route('adverts.show', $product)->with('success', __('Product is added to your favorites.'));
    }

    public function remove(Product $product)
    {
        try {
            $this->service->remove(Auth::id(), $product->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

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
