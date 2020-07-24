<?php

namespace App\Http\Controllers\Shop;

use App\UseCases\products\FavoriteService;
use App\Http\Controllers\Core;
use App\Models\Shop\Product;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function add(Product $product)
    {
        try {
            $this->service->add(Auth::id(), $product->id);
            return response()->json([
                'status' => 'success',
                'message' => $product->title . ' ' . __('Product added to your favorite.')
            ]);
        } catch (\DomainException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function remove(Product $product)
    {
        try {
            $this->service->remove(Auth::id(), $product->id);
            return response()->json([
                'status' => 'success',
                'message' => $product->title . ' ' . __('Product deleted to your favorite.')
            ]);
        } catch (\DomainException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
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
