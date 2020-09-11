<?php


namespace App\Repositories;

use App\Models\Shop\ProductPropertyValue as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


class ProductPropertyValueRepository extends CoreRepository
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
            ->where(function ($query) use ($categoryId) {
                if ($categoryId->children) {
                    return $query->where('category_id', $categoryId->id);
                }
                $query->where('sub_category_id', $categoryId->id);

            })
            ->with('property')
            ->groupBy('product_property_id')
            ->distinct()
            ->get();
//        return  $properties->map(static function ($item) {
//            return $item->product_property_id;
//        });
        $values = $this->startConditions()
            ->select('title', 'id', 'product_property_id')
            ->where(function ($query) use ($categoryId) {
                if ($categoryId->children) {
                    return $query->where('category_id', $categoryId->id);
                }
                $query->where('sub_category_id', $categoryId->id);

            })
            ->get();

        $data = [];
        foreach ($properties as $key => $itemProp) {
            foreach ($values as $k => $itemVal) {
                $data[$key] = $itemProp->property;
                if ($itemProp->property->id === $itemVal->product_property_id) {
                    $data[$key][$k] = $itemVal->title;
                }
            }
        }
        return $data;
//        foreach ($properties as $prKey => $prItem) {
//            foreach ($values as $valItem) {
//                if ($prItem->property->id === $valItem->value->product_property_id) {
//                    $data[$prKey]['property'] = $prItem->property;
//                    $data[$prKey]['values'][] = $valItem->value;
//                }
//            }
//        }
//        return $data;
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
