<?php


namespace App\Http\Controllers;

use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;

abstract class Core extends Controller
{
    /**
     * @var BlogPostRepository
     */
    protected $blogPostRepository;
    /**
     * @var BlogCategoryRepository
     */
    protected $blogCategoryRepository;
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
    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    public function __construct()
    {
        $this->pageRepository = app(PageRepository::class);
        $this->productCategoryRepository = app(ProductCategoryRepository::class);
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
        $this->productRepository = app(ProductRepository::class);
        $this->orderRepository = app(OrderRepository::class);
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * @return mixed
     */
    protected function BlogCategories()
    {
        $blogCategories = $this->blogCategoryRepository
            ->getAllCategory([
                'id',
                'title',
                'parent_id',
                'slug',
            ]);
        return $blogCategories;
    }
}

