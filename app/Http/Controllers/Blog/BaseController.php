<?php


namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;

abstract class BaseController extends Controller
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

    public function __construct()
    {
        $this->pageRepository = app(PageRepository::class);
        $this->productCategoryRepository = app(ProductCategoryRepository::class);
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = new BlogCategoryRepository;
        $this->productRepository = app(ProductRepository::class);
        $this->orderRepository = app(OrderRepository::class);
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
