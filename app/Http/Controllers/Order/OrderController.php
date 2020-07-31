<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Shop\Order;
use App\Services\Acquiring\Rshb;
use App\UseCases\Cart\CartService;
use App\UseCases\Order\OrderService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

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
     * @param CartService $cartService
     * @return Factory|View
     */
    public function place(CartService $cartService)
    {
        return view('order.place', $this->data, $cartService->getCart());
    }

    /**
     * @param Request $request
     * @param CartService $cartService
     * @param Rshb $bank
     * @return void
     */
//    public function confirm(OrderRequest $request)
//    {
//        $orderId = $this->service->getOrder()->id;
//        if ($this->phoneVerified()) {
//            $this->service->order($request, $orderId);
//            session()->put(['orderInfo' => $orderId]);
//            session()->forget('orderId');
//            $this->data = ['route' => route('order.info')];
//        } else {
//            $this->data = [
//                'error' => view('flash.index')
//                    ->with('error', __('The phone number was not confirmed'))
//                    ->render(),
//            ];
//        }
//        return response()->json($this->data);
//    }
    public function confirm(Request $request, CartService $cartService, Rshb $bank)
    {
        $order = $cartService->getOrder(); // Текущий заказ
        $total_cost = $cartService->getTotalSum();

        if ($request->get('payment_type') === 'bank_card') {
            $acquiringResult = $bank->orderRegistration(
                $order->id,
                $total_cost
            );
            if ($acquiringResult === false || !isset($acquiringResult['orderId'])) {
                return redirect()
                    ->back()
                    ->with(['error' => $acquiringResult['errorMessage']]);
            }
            /* Saved */
            $this->service->order($request, $total_cost, $order->id, $acquiringResult['orderId']);
            // В случаи успеха перенаправляем пользователя на страницу оплаты
            return redirect()->away($acquiringResult['formUrl']);
        }
        /* Saved */
        $this->service->order($request, $total_cost, $order->id);

        $this->data['orderInfo'] = $this->orderRepository
            ->getUserOrder($order->id)
            ->each(function ($item) {
                $item->number = $this->getOrderNumber($item->id);
                //$item->user_data = $this->toArray($item->user_data);
            })->first();
        session()->forget('orderId'); // Stay here
        return view('order.info', $this->data, $cartService->getCart());
    }

    /**
     * @param Request $request
     * @param CartService $cartService
     * @return Factory|View
     */
    public function confirmPayment(Request $request, CartService $cartService)
    {
        $acquiringOrderId = $request->get('orderId');

        $order = Order::where([
            'order_status' => 0,
            'acquiring_order_id' => $acquiringOrderId,
        ])->first();

        if (!$order) {
            return abort(404);
        }

        $order->order_status = true;
        $order->save();
        //session()->forget('orderId');
        dd($order);
        $this->data['orderInfo'] = $this->orderRepository
            ->getUserOrderAcquiring($acquiringOrderId)
            ->each(function ($item) {
                $item->number = $this->getOrderNumber($item->id);
                //$item->user_data = $this->toArray($item->user_data);
            })->first();
        return view('order.info', $this->data, $cartService->getCart());
    }

    /**
     * @param Request $request
     * @param CartService $cartService
     */
    public function cancelPayment(Request $request, CartService $cartService)
    {
        $acquiringOrderId = $request->get('orderId');

        dd($acquiringOrderId);
    }

    /**
     * Guest users
     * @return bool
     */
    private function phoneVerified(): bool
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
    public function getOrderNumber($id): string
    {
        return '№' . str_pad($id, 8, '0', STR_PAD_LEFT);
    }

    /**
     * @param $string
     * @return mixed
     */
    private function toArray($string)
    {
        return json_decode(preg_replace("/[\r\n]+/", ' ', $string), false);
    }
}
