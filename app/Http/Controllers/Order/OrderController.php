<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Shop\Order;
use App\UseCases\Order\OrderService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Core
{
    /**
     * @var array $data
     */
    protected $data = [];
    /**
     * @var OrderService $service
     */
    private $service;

    /**
     * OrderController constructor.
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
        $this->service = $service;

    }

    /**
     * Order registration
     * @return Factory|View
     */
    public function place()
    {
        if (!$this->getOrder()) {
            return redirect()->route('cart');
        }
        $this->getCart();
        return view('order.place', $this->data);
    }

    /**
     * @param OrderRequest $request
     * @return void
     */
    public function confirm(OrderRequest $request)
    {
        if ($this->service->order($request)) {

        }
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

    /**
     * @return Order|null
     */
    private function getOrder(): ?Order
    {
        return $this->orderRepository->findByOrderId(session('orderId'));
    }

}
