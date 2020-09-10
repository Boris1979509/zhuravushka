<?php


namespace App\Repositories;

use App\Models\Shop\ProductAttribute as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


class ProductAttributeRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param $categoryId
     * @return mixed
     */
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
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->startConditions()
            ->newQuery();
    }

}
