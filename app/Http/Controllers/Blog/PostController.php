<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PostController extends BaseController
{
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
     * @param string $slug
     * @return Factory|View
     */
    public function index(string $slug)
    {
        $this->data['post'] = $this->blogPostRepository->getPostBySlug($slug);
        return view('blog.post', $this->data);
    }
}
