<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Core
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
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $this->getCart();
        return view('cabinet.home', $this->data);
    }
    /**
     * Cart
     */
    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }
}
