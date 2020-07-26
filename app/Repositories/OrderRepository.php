<?php


namespace App\Repositories;

use App\Models\Shop\Order as Model;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends CoreRepository
{
    /**
     * @var OrderRepository
     */
    private $order;

    /**
     * Возвращает полное имя класса
     * @return string
     */


    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param $order
     * @return mixed
     */
    public function findByOrderId($order)
    {
        return $this->startConditions()
            ->find($order);
    }

    /**
     * @param $product
     * @param $inc
     * @param $order
     * @return mixed
     */
    public function pivotCount($product, $inc, $order)
    {
        if (!is_null($order)) {
            $message = '';
            $pivot = $order->products()
                ->where('product_id', $product->id)
                ->first()
                ->pivot;

            switch ($inc) {
                case '++':
                    $pivot->count++;
                    if ($pivot->count > $product->quantity) {
                        $underOrder = $pivot->count - $product->quantity;
                        $message = [
                            'status'  => 'info',
                            'message' => 'Доступно ' . $product->quantity . 'шт. в наличии + ' . $underOrder . ' под заказ.',
                        ];
                    } else {
                        $message = [
                            'status'  => 'success',
                            'message' => 'Товар ' . $product->title . ' упешно добавлен в корзину.',
                        ];
                    }
                    break;
                case '--':
                    $pivot->count--;
                    $message = [
                        'status'  => 'success',
                        'message' => 'Товар ' . $product->title . ' упешно удален из корзины.',
                    ];
                    break;
                case 'input':
                    break;
            }
            if ($pivot->count < 1) {
                $order->products()->detach($product);
            }
            $pivot->update();
            return $message;
        }
    }

    /**
     * @param integer $id
     * @return Collection
     */
    public function getUserOrder($id): Collection
    {
        return $this->startConditions()
            ->select('id', 'user_data', 'user_id')
            ->where('order_status', true)
            ->where('id', $id)
            ->with('Products')
            ->get();
    }

}
