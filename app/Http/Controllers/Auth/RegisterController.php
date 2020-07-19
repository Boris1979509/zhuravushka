<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Core;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\UseCases\Auth\PhoneService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Core
{

    //use RegistersUsers;
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
     * @var PhoneService $service
     */
    private $service;

    public function __construct(PhoneService $service)
    {
        parent::__construct();
        $this->middleware('guest');
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
        if (session('verified') && session('phone')) {
            $user = User::create([
                'name'               => $request['name'],
                'last_name'          => $request['last_name'],
                'middle_name'        => $request['middle_name'],
                'email'              => $request['email'],
                //'phone'              => $this->service->filterPhone(session('phone')),
                'phone'              => session('phone'),
                'phone_verified'     => true,
                'phone_verify_token' => session('token'),
                'password'           => Hash::make($request['password']),
                'delivery_place'     => $request['address'],
            ]);
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
}
