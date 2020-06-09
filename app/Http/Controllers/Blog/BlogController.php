<?php

namespace App\Http\Controllers\Blog;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\PageRepository;
use App\Repositories\ShopCategoryRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BlogController extends BaseController
{
    // Paginate
    public const LIMIT = 10;
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;
    /**
     * @var PageRepository
     */
    private $pageRepository;
    /**
     * @var ShopCategoryRepository
     */
    private $shopCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->pageRepository = app(PageRepository::class);
        $this->shopCategoryRepository = app(ShopCategoryRepository::class);
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $pages = $this->pageRepository->getAllPages();
        //$currentPage = $this->pageRepository->getSinglePage();
        $shopCategory = $this->shopCategoryRepository->getAllShopCategory();
        $paginator = $this->blogPostRepository->getAllWithPaginate(self::LIMIT);
        return view('blog.index', compact('paginator', 'pages', 'shopCategory'));
    }
}
