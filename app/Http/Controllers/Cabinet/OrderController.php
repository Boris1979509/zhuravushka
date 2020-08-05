<?php


namespace App\Http\Controllers\Cabinet;


use App\Http\Controllers\Core;
use App\Models\User;
use App\UseCases\Cart\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Core
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
     * @param CartService $cartService
     * @param User $user
     * @return Factory|View
     */
    public function index(CartService $cartService, User $user)
    {
        $this->data['user'] = $this->userRepository->findUserWithOrdersProducts(Auth::id());
        return view('cabinet.order.index', $this->data, $cartService->getCart());
    }
}
