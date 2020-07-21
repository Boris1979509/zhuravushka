<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Core;
use App\Http\Requests\Order\OrderRequest;
use App\UseCases\Order\OrderService;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Throwable;

class CartController extends Core
{
    /**
     * @var array $data
     */
    protected $data = [];
    /**
     * @var OrderService $service
     */
    private $service;

    public function __construct(OrderService $service)
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
        $this->service = $service;

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
        if (!$request->wantsJson()) {
            abort(400);
        }
        /** @var  Order $order */
        $message = '';
        $product = $this->productRepository->getProductFirst($product);

        if (is_null(session('orderId'))) {
            $order = $order->create();
            session(['orderId' => $order->id]);
        }
        $order = $this->getOrder();

        if ($order->products->contains($product)) {
            $inc = $request->input('inc'); // increments ++ --
            $message = $this->orderRepository->pivotCount($product, $inc, $order);
        } else {
            $message = 'Товар ' . $product->title . ' упешно добавлен в корзину.';
            $order->products()->attach($product);
        }

        $this->getCartAjax();
        $this->data['cartItemTotalSum'] = $this->numberFormat($order->products()->find($product)->getItemTotalSum());
        $this->data['dataMsg'] = ['status' => 'success', 'message' => $message];

        return response()->json($this->data);
    }

    /**
     * @param $product
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function remove($product, Request $request): JsonResponse
    {
        if (!$request->wantsJson()) {
            abort(400);
        }
        $order = $this->getOrder();

        if ($product = $this->productRepository->getProductFirst($product)) {
            $order->products()->detach($product);
            $this->getCartAjax();
            $this->data['dataMsg'] = ['status' => 'success', 'message' => 'Товар ' . $product->title . ' упешно удален из корзины.'];
            if (!$order->cartCount()) {
                $order->forceDelete();
                session()->forget('orderId');
                $this->getCartAjax();
                //$this->data['dataMsg'] = ['status' => 'success', 'message' => __('CartEmptyMessage')];
                $this->data['view'] = view('shop.cart', $this->data)->render();
                return response()->json($this->data);
            }
        }

        return response()->json($this->data);
    }

    /**
     * Get Cart
     */
    private function getCart(): void
    {
        if ($order = $this->getOrder()) {
            $this->data['order'] = $order;
            $this->data['cartCount'] = $order->cartCount();
            $this->data['cartTotalSum'] = $order->getTotalSum();
        }
    }

    private function getCartAjax(): void
    {
        $this->data = [];
        if ($order = $this->getOrder()) {
            $this->data['order'] = $order;
            $this->data['cartCount'] = $order->cartCount();
            $this->data['cartTotalSum'] = $this->numberFormat($order->getTotalSum());
        }
    }

    /**
     * @return Order|null
     */
    private function getOrder(): ?Order
    {
        return $this->orderRepository->findByOrderId(session('orderId'));
    }

    /**
     * @param $str
     * @return string
     */
    private function numberFormat($str): string
    {
        return number_format($str, 0, '', ' ');
    }
}
