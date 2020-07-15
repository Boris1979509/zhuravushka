<?php


namespace App\Repositories;

use App\Models\Shop\Order as Model;

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
                    $message = 'Товар ' . $product->title . ' упешно добавлен в корзину.';
                    break;
                case '--':
                    $pivot->count--;
                    $message = 'Товар ' . $product->title . ' упешно удален из корзины.';
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

}
