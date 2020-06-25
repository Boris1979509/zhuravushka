<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\Product;
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
        $this->refreshCart();
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
        $this->refreshCart();

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

        if ($product = $this->productRepository->getProductFirst($product)) {
            $order->products()->detach($product);

            $this->data['message'] = $product->title . ' remove from cart.';
            if (!$order->cartCount()) {
                $order->forceDelete();
                session()->remove('orderId');
                $this->data['message'] = 'Your cart is Empty.';
                $this->refreshCart();
                $this->data['view'] = view('shop.cart', $this->data)->render();
                return response()->json($this->data);
            }
        }
        $this->refreshCart();
        return response()->json($this->data);
    }


    private function refreshCart(): void
    {
        $order = $this->orderRepository->find();
        $this->data['order'] = $order;
        $this->data['cartCount'] = ($order) ? $order->products()->count() : 0;
        $this->data['cartTotalSum'] = ($order) ? $order->getTotalSum() : 0;
    }
}
