<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProductRepository;
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
    /**
     * @var ProductRepository
     */
    protected $productRepository;
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    public function __construct()
    {
        $this->pageRepository = app(PageRepository::class);
        $this->productCategoryRepository = app(ProductCategoryRepository::class);
        $this->productRepository = app(ProductRepository::class);
        $this->orderRepository = app(OrderRepository::class);
    }
}
