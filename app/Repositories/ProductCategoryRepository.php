<?php


namespace App\Repositories;

use App\Models\Shop\ProductCategory as Model;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
            ->with(['children' => static function ($query) {
                $query->withCount('Products as productsCount');
            }])->get();
    }

    /**
     * @return mixed
     */
    public function getHomePageTop()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'parent_id',
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('parent_id', 0)
            ->orderBy('title', 'DESC')
            ->with(['children' => static function ($query) {
                $query->with('products');
            }])->offset(15)->limit(4)->get();
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
            ->with(['parent', 'attributes', 'children' => static function ($query) {
                $query->withCount('products as productCount');
            }])
            ->first();
    }
    public function getAttributes($categoryId)
    {
        $properties = $this->startConditions()
            ->select('product_property_id')
            ->where('category_id', $categoryId)
            ->with('property')
            ->groupBy('product_property_id')
            ->distinct()
            ->get();
        $ids = $properties->map(static function ($item) {
            return $item->property->id;
        });
        $values = $this->startConditions()
            ->select('product_property_value_id')
            ->where('category_id', $categoryId)
            ->whereIn('product_property_id', $ids)
            ->with('value')
            ->groupBy('product_property_value_id')
            ->distinct()
            ->get();

        $data = [];
        foreach ($properties as $prKey => $prItem) {
            foreach ($values as $valItem) {
                if ($prItem->property->id === $valItem->value->product_property_id) {
                    $data[$prKey]['property'] = $prItem->property;
                    $data[$prKey]['values'][] = $valItem->value;
                }
            }
        }
        return $data;
    }
}
