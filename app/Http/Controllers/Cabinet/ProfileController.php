<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core;
use App\Http\Requests\Cabinet\ProfileUpdateRequest;
//use App\UseCases\Profile\ProfileService;
use App\UseCases\Cart\CartService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

    /**
     * @param CartService $cartService
     * @return Factory|View
     */
    public function edit(CartService $cartService)
    {
        //$user = Auth::user();
        return view('cabinet.profile.edit', $this->data, $cartService->getCart());
    }

    /**
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $this->service->edit(Auth::id(), $request);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.profile.home');
    }
}
