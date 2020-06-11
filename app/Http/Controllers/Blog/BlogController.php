<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends BaseController
{
    // Paginate
    public const LIMIT = 10;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $pages = $this->pageRepository->getAllPages();

        $str = explode("/", $request->path());
        $page = $this->pageRepository->getSinglePage($str[1]);

        $blogCategories = $this->BlogCategories();

        $shopCategory = $this->shopCategoryRepository->getAllShopCategory();
        $paginator = $this->blogPostRepository->getAllWithPaginate(self::LIMIT);
        return view('blog.index', compact('paginator', 'pages', 'shopCategory', 'page', 'blogCategories'));
    }

    /**
     * @param string $slug
     * @return View
     */
    public function getByCategory(string $slug): view
    {
        $category = $this->blogCategoryRepository->getCategoryBySlug($slug);
        $paginator = $this->blogPostRepository->getAllWithPaginate(self::LIMIT, $category->id);
        $pages = $this->pageRepository->getAllPages();

        $page = $category; // title, description
        $blogCategories = $this->BlogCategories(); // left bar menu

        $shopCategory = $this->shopCategoryRepository->getAllShopCategory();
        return view('blog.index', compact('paginator', 'pages', 'shopCategory', 'page', 'blogCategories'));
    }
}
