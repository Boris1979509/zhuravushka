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
            $pivot = $order->products()
                ->where('product_id', $product->id)
                ->first()
                ->pivot;

            switch ($inc) {
                case '++':
                    $pivot->count++;
                    break;
                case '--':
                    $pivot->count--;
                    break;
                case 'input':
                    break;
            }
            if ($pivot->count < 1) {
                $order->products()->detach($product);
            }
            return $pivot->update();
        }
    }

}
