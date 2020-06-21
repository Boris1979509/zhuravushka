<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;

class ProductCategoryController extends BaseController
{
    /**
     * @param $category
     */
    public function index($category)
    {
        dd($category);
    }
}
