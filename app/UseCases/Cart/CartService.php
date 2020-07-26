<?php

namespace App\UseCases\Cart;


use App\Models\Shop\Order;
use App\Repositories\OrderRepository;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Throwable;

class CartService
{
    /**
     * @var Order $order
     */
    protected $order;

    /**
     * CartService constructor.
     * @param bool $orderCreated
     */
    public function __construct($orderCreated = false)
    {
        $this->getOrder($orderCreated);
    }

    /**
     * @param $orderCreated
     */
    public function getOrder($orderCreated): void
    {
        $order = session('orderId');
        if (is_null($order) && $orderCreated) {
            $this->order = Order::create();
            session(['orderId' => $this->order->id]);
        } else {
            $this->order = (new OrderRepository())->findByOrderId($order);
        }
    }

    /**
     * Add to cart
     * @param Product $product
     * @param Request $request
     * @return mixed|string
     */
    public function add(Product $product, Request $request)
    {
        if ($this->order->products->contains($product)) {
            $inc = $request->input('inc'); // increments ++ --
            $result = (new OrderRepository())->pivotCount($product, $inc, $this->order);
        } else {
            $result = ['status' => 'success', 'message' => 'Товар ' . $product->title . ' упешно добавлен в корзину.'];
            $this->order->products()->attach($product);
        }

        return [
                'cartItemTotalSum' => $this->numberFormat($this->order->products()->find($product)->getItemTotalSum()),
                'dataMsg'          => $result,
            ] + $this->getCart();
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return array
     * @throws Throwable
     */
    public function remove(Product $product, Request $request): array
    {
        $this->order->products()->detach($product);
        if (!$this->order->cartCount()) {
            $this->order->forceDelete();
            session()->forget('orderId');
            return [
                'dataMsg' => [
                    'status'  => 'success',
                    'message' => __('CartEmptyMessage'),
                ],
                'view'    => view('shop.cart', [])->render(),
            ];
        }
        return [
                'dataMsg' => [
                    'status'  => 'success',
                    'message' => 'Товар ' . $product->title . ' упешно удален из корзины.',
                ],
            ] + $this->getCart();
    }

    /**
     * @return array
     */
    public function getCart(): array
    {
        if (is_null($this->order)) {
            return [];
        }
        return [
            'order'        => $this->order,
            'cartCount'    => $this->order->cartCount(),
            'cartTotalSum' => $this->numberFormat($this->getTotalSum()),
        ];
    }

    /**
     * @param $str
     * @return string
     */
    private function numberFormat($str): string
    {
        return number_format($str, 0, '', ' ');
    }

    /**
     * @return string
     */
    public function getTotalSum(): string
    {
        if ($total = (new OrderRepository())->findByOrderId($this->order->id)->getTotalSum()) {
            return $total;
        }
    }

}
