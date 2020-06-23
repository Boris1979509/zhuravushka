<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends BaseController
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

    public function index()
    {
        $orderId = session()->get('orderId');
        $order = $this->orderRepository->find($orderId);
        $this->data['order'] = $order;
        $this->data['cartCount'] = $order->cartCount();
        return view('shop.userCart', $this->data);
    }

    /**
     * @param $product
     * @param Request $request
     * @return JsonResponse
     */
    public function add($product, Request $request): JsonResponse
    {
        $product = $this->productRepository->getProductFirst($product);

        $orderId = session()->get('orderId');
        if (is_null($orderId)) {
            $order = $this->orderRepository->create();
            session()->put(['orderId' => $order->id]);
        } else {
            $order = $this->orderRepository->find($orderId);
        }
        if ($order->products->contains($product)) {
            $inc = $request->input('inc');
            $this->orderRepository->pivotCount($product, $inc);
        } else {
            $order->products()->attach($product); // соединить модели pivot
        }

        $this->data['cartCount'] = $order->cartCount();
        $this->data['message'] = $product->title . ' added to cart.';
        return response()->json($this->data);
    }

    /**
     * @param $product
     * @return JsonResponse
     */
    public function remove($product): JsonResponse
    {
        $orderId = session()->get('orderId');
        $order = $this->orderRepository->find($orderId);

        if ($this->productRepository->getProductFirst($product)) {
            $order->products()->detach($product);
        }

        $this->data['message'] = $product->title . ' remove from cart.';
        return response()->json($this->data);
    }


}
