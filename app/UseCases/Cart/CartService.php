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

    public $isUnderOrder = false;

    /**
     * CartService constructor.
     * @param bool $orderCreated
     */
    public function __construct($orderCreated = false)
    {
        $this->load($orderCreated);
    }

    /**
     * @param bool $orderCreated
     */
    public function load($orderCreated): void
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
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return array
     */
    public function add(Product $product, Request $request)
    {
        if ($this->order->products->contains($product)) {
            $inc = $request->input('inc'); // increments ++ --
            $result = $this->pivotCount($this->order->pivot($product), $product, $inc);
        } else {
            $result = ['status' => 'success', 'message' => 'Товар ' . $product->title . ' упешно добавлен в корзину.'];
            $this->order->products()->attach($product);
        }

        return [
                'cartItemTotalSum' => $this->numberFormat($this->order->products()->find($product)->getItemTotalSum()),
                'dataMsg' => $result,
            ] + $this->getCart();
    }

    /**
     * @param $pivot
     * @param Product $product
     * @param $inc
     * @return array|string
     */
    public function pivotCount($pivot, $product, $inc)
    {
        if ($this->order) {
            $message = '';
            switch ($inc) {
                case '++':
                    $pivot->count++;
                    if ($underOrder = $this->underOrder($pivot, $product)) {
                        $message = [
                            'status' => 'info',
                            'message' => 'Доступно '
                                . $underOrder['unit_pricing_base_measure']
                                . ' в наличии + ' . $underOrder['under_order']
                                . ' под заказ.',
                            'underOrder' => $underOrder
                        ];
                        $pivot->update(['under_order' => intval($underOrder['under_order'])]);
                    } else {
                        $message = [
                            'status' => 'success',
                            'message' => 'Товар ' . $product->title . ' упешно добавлен в корзину.',
                        ];
                    }
                    break;
                case '--':
                    $pivot->count--;
                    if ($underOrder = $this->underOrder($pivot, $product)) {
                        $message = [
                            'status' => 'info',
                            'message' => 'Доступно '
                                . $underOrder['unit_pricing_base_measure']
                                . ' в наличии + ' . $underOrder['under_order']
                                . ' под заказ.',
                            'underOrder' => $underOrder
                        ];
                        $pivot->update(['under_order' => intval($underOrder['under_order'])]);
                    } else {
                        $message = [
                            'status' => 'success',
                            'message' => 'Товар ' . $product->title . ' упешно удален из корзины.',
                        ];
                    }
                    break;
                case 'input':
                    break;
            }
            if ($pivot->count < 1) {
                $this->order->products()->detach($product);
            }
            $pivot->update();
            return $message;
        }
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
                    'status' => 'success',
                    'message' => __('CartEmptyMessage'),
                ],
                'view' => view('shop.cart', [])->render(),
            ];
        }
        return [
                'dataMsg' => [
                    'status' => 'success',
                    'message' => 'Товар ' . $product->title . ' упешно удален из корзины.',
                    'underOrder' => $this->underOrderCount(),
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
            'order' => $this->order,
            'cartCount' => $this->order->cartCount(),
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

    /**
     * Under Order
     * @param $pivot
     * @param Product $product
     * @return array|null
     */
    public function underOrder($pivot, $product): ?array
    {
        if ($pivot->count > $product->quantity) {
            $this->isUnderOrder = true;
            $underOrder = $pivot->count - $product->quantity;
            return [
                'unit_pricing_base_measure' => $product->quantity . $product->unit_pricing_base_measure . '.',
                'under_order' => $underOrder . $product->unit_pricing_base_measure . '.',
                'price' => $product->price
            ];
        }
        return null;
    }

    /**
     * if empty under order
     * @return int
     */
    public function underOrderCount()
    {
        foreach ($this->order->products as $item) {
            return $item->pivot->under_order;
        }
    }

}
