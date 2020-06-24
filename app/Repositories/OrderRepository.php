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
     * @return mixed
     */
    public function find()
    {
        if (!is_null($order = session()->get('orderId'))) {
            return $this->startConditions()
                ->find($order);
        }
        return null;
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
        $order = $this->find();
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

    /**
     * @return mixed
     */
    public function cartCount()
    {
        if (!is_null($this->find())) {
            return $this->find()
                ->products()->count();
        }
    }

}
