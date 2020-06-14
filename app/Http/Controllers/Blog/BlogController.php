<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BlogController extends BaseController
{
    // Paginate
    public const LIMIT = 10;
    /**
     * @var array $data
     */
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['blogCategories'] = $this->BlogCategories();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $this->data['paginator'] = $this->blogPostRepository->getAllWithPaginate(self::LIMIT);
        return view('blog.index', $this->data);
    }

    /**
     * @param string $slug
     * @return View
     */
    public function getByCategory(string $slug): view
    {
        $this->data['category'] = $this->blogCategoryRepository->getCategoryBySlug($slug);
        $this->data['paginator'] = $this->blogPostRepository
            ->getAllWithPaginate(self::LIMIT, $this->data['category']->id);

        return view('blog.index', $this->data);
    }
}
