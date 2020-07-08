<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Core;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BlogController extends Core
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
        $this->getCart();
        $this->data['paginator'] = $this->blogPostRepository->getAllWithPaginate(self::LIMIT);
        return view('blog.index', $this->data);
    }

    /**
     * @param string $slug
     * @return View
     */
    public function getByCategory(string $slug): view
    {
        $this->getCart();
        $this->data['category'] = $this->blogCategoryRepository->getCategoryBySlug($slug);
        $this->data['paginator'] = $this->blogPostRepository
            ->getAllWithPaginate(self::LIMIT, $this->data['category']->id);

        return view('blog.index', $this->data);
    }

    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }
}
