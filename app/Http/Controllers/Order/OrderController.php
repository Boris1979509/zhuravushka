<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Shop\Order;
use App\UseCases\Order\OrderService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
     * @return JsonResponse|RedirectResponse
     * @throws \Throwable
     */
    public function confirm(OrderRequest $request)
    {
        $orderId = session('orderId');
        if ($this->phoneVerified()) {
            $this->service->order($request, $orderId);
            session()->put(['orderInfo' => $orderId]);
            session()->forget('orderId');
            $this->data = ['route' => route('order.info')];
        } else {
            $this->data = [
                'error' => view('flash.index')
                    ->with('error', __('The phone number was not confirmed'))
                    ->render()
            ];
        }
        return response()->json($this->data);
    }

    /**
     * Information by order
     * @return Factory|View
     */
    public function info()
    {
        $id = session('orderInfo');
        $this->data['orderInfo'] = $this->orderRepository
            ->getUserOrder($id)
            ->each(function ($item) {
                $item->number = $this->getOrderNumber($item->id);
                $item->user_data = $this->toArray($item->user_data);
            })->first();

        $this->getCart();
        return view('order.info', $this->data);
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

    /**
     * Guest users
     * @return bool
     */
    private function phoneVerified()
    {
        if (session('verified') && session('phone')) {
            return true;
        }
        return false;
    }

    /**
     * @param integer $id
     * @return string
     */
    public function getOrderNumber($id)
    {
        return '№' . str_pad($id, 8, "0", STR_PAD_LEFT);
    }

    /**
     * @param $string
     * @return mixed
     */
    private function toArray($string)
    {
        return json_decode(preg_replace("/[\r\n]+/", " ", $string));
    }

}
