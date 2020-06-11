<?php


namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\PageRepository;
use App\Repositories\ShopCategoryRepository;

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
     * @var ShopCategoryRepository
     */
    protected $shopCategoryRepository;

    public function __construct()
    {
        $this->pageRepository = app(PageRepository::class);
        $this->shopCategoryRepository = app(ShopCategoryRepository::class);
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
