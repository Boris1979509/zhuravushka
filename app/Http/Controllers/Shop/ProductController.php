<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends BaseController
{
    /**
     * @var array $data
     */
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }

    /**
     * @param $code
     * @return Factory|View
     */
    public function index($code)
    {
        $this->data['product'] = $this->productRepository->getCodeFirst($code);
        return view('shop.product', $this->data);
    }
}
