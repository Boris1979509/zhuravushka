<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Core;
use App\Http\Requests\Cabinet\ChangePasswordRequest;
use App\UseCases\Cart\CartService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;

class ChangePasswordController extends Core
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * ChangePasswordController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }

    /**
     * @param CartService $cartService
     * @return Factory|View
     */
    public function index(CartService $cartService)
    {
        $this->data['user'] = Auth::user();
        return view('cabinet.profile.changePassword', $cartService->getCart(), $this->data);
    }

    /**
     * @param ChangePasswordRequest $request
     * @param MatchOldPassword $rule
     */
    public function store(ChangePasswordRequest $request, MatchOldPassword $rule)
    {
        Auth::user()->update([
            'password' => Hash::make($request['new_password'])
        ]);

        dd('Password change successfully.');
    }
}
