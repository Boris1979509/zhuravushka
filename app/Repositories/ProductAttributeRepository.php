<?php


namespace App\Repositories;

use App\Models\Shop\ProductAttribute as Model;
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
    public function getProperties($categoryId)
    {
        // SELECT DISTINCT `product_property_id` FROM `product_attributes` WHERE `category_id` = 35
        // SELECT DISTINCT `product_property_value_id` FROM `product_attributes` WHERE `category_id` = 35 AND `product_property_id` = 9;
        // SELECT DISTINCT `product_property_value_id` FROM `product_attributes` WHERE `category_id` = 35 GROUP by `product_property_value_id`;
        return $this->startConditions()
            ->select('product_property_id')
            ->where('category_id', $categoryId)
            ->with('property')
            ->groupBy('product_property_id')
            ->distinct()
            ->toSql();

    }

}
