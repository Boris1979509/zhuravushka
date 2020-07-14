<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core;
use App\Http\Requests\Cabinet\ProfileUpdateRequest;
//use App\UseCases\Profile\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Core
{
    /**
     * @var array
     */
    protected $data = [];
    private $service;

    public function __construct()
    {
        parent::__construct();
        //$this->middleware('auth');
        //$this->service = app(ProfileService::class);
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }



//    public function __construct(ProfileService $service)
//    {
//        $this->service = $service;
//    }

    public function index()
    {
        //$user = Auth::user();

        return view('cabinet.profile.home', $this->data);
    }

    public function edit()
    {
        //$user = Auth::user();
        $this->getCart();
        return view('cabinet.profile.edit', $this->data);
    }

    public function update(ProfileUpdateRequest $request)
    {
        try {
            $this->service->edit(Auth::id(), $request);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.profile.home');
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
