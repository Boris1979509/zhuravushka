<?php


namespace App\Repositories;
use App\Models\Shop\ShopCategory as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;

class ShopCategoryRepository extends CoreRepository
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
     * @return Application[]|Collection|\Illuminate\Database\Eloquent\Model[]|mixed[]
     */
    public function getAllShopCategory(){
        $result = $this->startConditions()->all();
        return $result;
    }
}
