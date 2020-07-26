<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Core;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\UseCases\Auth\PhoneService;
use App\UseCases\Auth\RegisterService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Core
{

    /**
     * @var array
     */
    protected $data = [];
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * @var RegisterService $service
     */
    private $service;

    public function __construct(RegisterService $service)
    {
        parent::__construct();
        //$this->middleware('guest');
        $this->service = $service;
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        if ($this->phoneVerified()) {
            $this->service->register($request);
            $this->service->forget();// Session destroy
            $message = ['success' => __('SuccessfulRegistrationInfo')];
            $this->data = ['success' => view('flash.index', $message)->render()];
        } else {
            $message = ['error' => __('The phone number was not confirmed')];
            $this->data = ['error' => view('flash.index', $message)->render()];
        }
        return response()->json($this->data);
    }

    /**
     * @return Factory|View
     */
    public function showRegistrationForm(): View
    {
        $this->getCart();
        return view('auth.register', $this->data);
    }

    private function getCart(): void
    {
        $this->data['order'] = $this->orderRepository->findByOrderId(session('orderId'));
        $this->data['cartCount'] = ($this->data['order']) ? $this->data['order']->cartCount() : null;
    }

    /**
     * Guest users
     * @return bool
     */
    private function phoneVerified(): bool
    {
        if (session('verified') && session('phone')) {
            return true;
        }
        return false;
    }
}
