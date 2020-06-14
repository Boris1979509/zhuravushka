<?php


namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProductCategoryRepository;

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
    protected $shopCategoryRepository;

    public function __construct()
    {
        $this->pageRepository = app(PageRepository::class);
        $this->productCategoryRepository = app(ProductCategoryRepository::class);
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = new BlogCategoryRepository;
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
