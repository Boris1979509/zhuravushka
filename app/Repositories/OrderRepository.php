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
