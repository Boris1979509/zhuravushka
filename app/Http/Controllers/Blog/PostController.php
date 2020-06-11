<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $slug)
    {
        $pages = $this->pageRepository->getAllPages();

        $post = $this->blogPostRepository->getPostBySlug($slug);
        $page = $post; // title, description
        $blogCategories = $this->BlogCategories(); // left bar menu

        $shopCategory = $this->shopCategoryRepository->getAllShopCategory();
        return view('blog.post', compact('post', 'blogCategories', 'page', 'pages', 'shopCategory'));
    }
}
