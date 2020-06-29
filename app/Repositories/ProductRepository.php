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
            ->take(10)->get();
    }

    /**
     * @param $product
     * @return mixed
     */
    public function getProductFirst($product)
    {
        return $this->startConditions()
            ->find($product);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getBySlug($slug)
    {
        $columns = ['*'];
        return $this->startConditions()
            ->select($columns)
            ->with('category')
            ->where('slug', $slug)
            ->first();
    }
}
