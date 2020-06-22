<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\Product;
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
        $this->data['order'] = $this->orderRepository->find($orderId);

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
        // соединить модели
        $order->products()->attach($product);
//        $cart = session()->has('cart') ? session()->get('cart') : [];
//        if (array_key_exists($product->id, $cart)) {
//            $cart[$product->id]['quantity'] = $request->input('qty');
//        } else {
//            $order = Order::create();
//            $cart[$product->id] = [
//                'id' => $product->id,
//                'order_id' => $order->id,
//                'quantity' => $request->input('qty')
//            ];
//        }
//        session(['cart' => $cart]);
//        session()->flash('message', $product->title.' added to cart.');

        $this->data['order'] = $order;
        $this->data['message'] = $product->title . ' added to cart.';
        return response()->json($this->data);
    }
}
