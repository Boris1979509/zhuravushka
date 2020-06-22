<?php


namespace App\Repositories;

use App\Models\Shop\Order as Model;

class OrderRepository extends CoreRepository
{

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
            ->find($order);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return $this->startConditions()->create();
    }

}
