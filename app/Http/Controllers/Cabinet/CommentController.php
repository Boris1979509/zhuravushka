<?php


namespace App\Http\Controllers\Cabinet;


use App\Http\Controllers\Core;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CommentController extends Core
{
    /**
     * @var array
     */
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        //$this->middleware('auth');
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $this->getCart();
        return view('cabinet.comment.index', $this->data);
    }

    /**
     * Cart
     * @return void
     */
    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }
}
