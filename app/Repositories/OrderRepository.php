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
    public function find($order)
    {
        return $this->startConditions()
            ->find($order)
            ->with('products')
            ->first();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return $this->startConditions()->create();
    }

    /**
     * @param $product
     * @param $inc
     * @return mixed
     */
    public function pivotCount($product, $inc)
    {
        $order = $this->find(session()->get('orderId'));
        $pivot = $order->products()
            ->where('product_id', $product->id)
            ->first()
            ->pivot;
        ("++" === $inc) ? $pivot->count++ : $pivot->count--;
        if ($pivot->count < 1) {
            $order->products()->detach($product);
        }
        return $pivot->update();
    }
}
