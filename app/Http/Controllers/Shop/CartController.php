<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Repositories\ProductRepository;
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
        $this->getCart();
        return view('shop.userCart', $this->data);
    }

    /**
     * @param $product
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function add($product, Request $request, Order $order): JsonResponse
    {
        /** @var  Order $order */

        $product = $this->productRepository->getProductFirst($product);

        if (is_null(session('orderId'))) {
            $order = $order->create();
            session(['orderId' => $order->id]);
        }
        $order = $this->orderRepository->findByOrderId(session('orderId'));

        if ($order->products->contains($product)) {
            $inc = $request->input('inc'); // increments ++ --
            $this->orderRepository->pivotCount($product, $inc, $order);
        } else {
            $order->products()->attach($product);
        }

        $this->data['cartItemTotalSum'] = $order->products()->find($product)->getItemTotalSum();
        $this->getCart();

        return response()->json($this->data);
    }

    /**
     * @param $product
     * @return JsonResponse
     * @throws Throwable
     */
    public function remove($product): JsonResponse
    {
        $order = $this->orderRepository->findByOrderId(session('orderId'));

        if ($product = $this->productRepository->getProductFirst($product)) {
            $order->products()->detach($product);
            $this->data['message'] = $product->title . ' remove from cart.';
            if (!$order->cartCount()) {
                $order->forceDelete();
                session()->remove('orderId');
                $this->data['message'] = 'Your cart is Empty.';
                $this->data['view'] = view('shop.cart', $this->data)->render();
                return response()->json($this->data);
            }
        }
        $this->getCart();
        return response()->json($this->data);
    }

    /**
     * order registration
     * @return Factory|View
     */
    public function place()
    {
        $this->getCart();
        return view('shop.place', $this->data);
    }

    public function confirm(Request $request)
    {
        if ($order = session()->has('orderId')) {
            $this->orderRepository->findByOrderId($order);
            return redirect()->route('shop.place');
        }
        return redirect()->route('home');

    }

    private function getCart(): void
    {
        $order = $this->orderRepository->findByOrderId(session('orderId'));
        if ($order) {
            $this->data['order'] = $order;
            $this->data['cartCount'] = $order->cartCount();
            $this->data['cartTotalSum'] = $order->getTotalSum();
        }
    }
}
