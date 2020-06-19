<?php


namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Repositories\ProductCategoryRepository;

abstract class BaseController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $pageRepository;
    /**
     * @var ProductCategoryRepository
     */
    protected $productCategoryRepository;

    public function __construct()
    {
        $this->pageRepository = app(PageRepository::class);
        $this->productCategoryRepository = app(ProductCategoryRepository::class);
    }
}
