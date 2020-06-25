<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

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

    /**
     * @return Factory|View
     */
    public function index()
    {
        $this->data['order'] = $this->orderRepository->find();
        $this->data['cartCount'] = $this->orderRepository->cartCount();
        return view('shop.userCart', $this->data);
    }

    /**
     * @param $product
     * @param Request $request
     * @return JsonResponse
     */
    public function add($product, Request $request): JsonResponse
    {
        /** @var  Order $order */

        $product = $this->productRepository->getProductFirst($product);

        if (is_null(session()->get('orderId'))) {
            $order = $this->orderRepository->create();
            session()->put(['orderId' => $order->id]);
        }
        $order = $this->orderRepository->find();

        if ($order->products->contains($product)) {
            $inc = $request->input('inc'); // increments ++ --
            $this->orderRepository->pivotCount($product, $inc);
        } else {
            $order->products()->attach($product);
        }

        $this->data['cartItemTotalSum'] = $order->products()->find($product)->numberFormat();
        $this->refreshCart($order);

        return response()->json($this->data);
    }

    /**
     * @param $product
     * @return JsonResponse
     * @throws Throwable
     */
    public function remove($product): JsonResponse
    {
        $order = $this->orderRepository->find();
        $this->data['order'] = $order;

        if ($product = $this->productRepository->getProductFirst($product)) {
            $order->products()->detach($product);
            $this->refreshCart($order);
            $this->data['message'] = $product->title . ' remove from cart.';
            if ($order->cartCount() === 0) {
                $order->forceDelete();
                session()->remove('orderId');
                $this->data['message'] = 'Your cart is Empty.';
                return response()->json([
                    'view' => view('shop.cart', $this->data)->render()
                ]);
            }
        }

        return response()->json($this->data);
    }

    /**
     * @param $order
     */
    private function refreshCart($order)
    {
        $this->data['cartCount'] = $order->cartCount();
        $this->data['cartTotalSum'] = $this->orderRepository->find()->getTotalSum();
    }
}
