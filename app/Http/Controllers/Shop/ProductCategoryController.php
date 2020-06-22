<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;

class ProductCategoryController extends BaseController
{

    public function index()
    {
        dd(__METHOD__);
    }

    public function category($category)
    {
        dd($category);
    }
}
