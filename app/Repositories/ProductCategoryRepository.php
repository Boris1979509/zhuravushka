<?php


namespace App\Repositories;

use App\Models\Shop\ProductCategory as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;

class ProductCategoryRepository extends CoreRepository
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
    public function getAllProductCategories()
    {
        $columns = [
            'id',
            'title',
            'slug',
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('parent_id', 0)
            ->with('children')
            ->take(10)->get();
    }

    /**
     * @param $slug
     * @param array $columns
     * @return mixed
     */
    public function getBySlug($slug, $columns = ['*'])
    {
        return $this->startConditions()
            ->select($columns)
            ->where('slug', $slug)
            ->first();
    }
}
