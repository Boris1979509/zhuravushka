<?php


namespace App\Repositories;

use App\Models\Shop\Product as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends CoreRepository
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
     * @param array $columns
     * @return mixed
     */
    public function getAllProducts($columns = ['*'])
    {
        return $this->startConditions()
            ->select($columns)
            ->with('category')
            ->get();
    }

    /**
     * @param $product
     * @return mixed
     */
    public function getProductFirst($product)
    {
        return $this->startConditions()
            ->findOrFail($product);
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getCodeFirst($code)
    {
        $columns = ['*'];
        return $this->startConditions()
            ->select($columns)
            ->with('category')
            ->where('code', $code)->first();
    }
}
