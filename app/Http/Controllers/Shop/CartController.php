<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Order;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        /**
         * @var  Order $order
         */
        $order;

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

        $this->data['cartCount'] = $order->cartCount();
        $this->data['cartItemTotalSum'] = $order->products()->find($product)->numberFormat();
        $this->data['cartTotalSum'] = $this->orderRepository->find()->getTotalSum();

        return response()->json($this->data);
    }

    /**
     * @param $product
     * @return JsonResponse
     */
    public function remove($product): JsonResponse
    {
        $order = $this->orderRepository->find();

        if ($this->productRepository->getProductFirst($product)) {
            $order->products()->detach($product);
        }

        $this->data['message'] = $product->title . ' remove from cart.';
        return response()->json($this->data);
    }


}
