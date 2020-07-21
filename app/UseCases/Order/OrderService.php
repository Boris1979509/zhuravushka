<?php

namespace App\UseCases\Order;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Shop\Order;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\SuccessfulRegistration;
use App\UseCases\Auth\PhoneService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * @var Mailer $mailer
     */
    private $mailer;
    /**
     * @var Dispatcher $dispatcher
     */
    private $dispatcher;
    /**
     * @var PhoneService $service
     */
    private $service;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher, PhoneService $service)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
        $this->service = $service;
    }

    /**
     * @param OrderRequest $request
     * @return bool
     */
    public function order(OrderRequest $request): bool
    {
        $orderId = session('orderId');
        return Order::updateOrder([
            'user_id' => Auth::id(),
            'order_status' => true,
            'user_data' => [
                'contacts' => [
                    'name' => Str::ucfirst($request['name']),
                    'last_name' => $request['last_name'],
                    'middle_name' => $request['middle_name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                ],
                'delivery_place' => [
                    'city' => $request['city'],
                    'street' => $request['street'],
                    'house_number' => $request['house_number'],
                ],
                'date_time' => [
                    'delivery_date' => $request['delivery_date'],
                    'delivery_time' => $request['delivery_time'],
                ],
            ],
            'comment' => $request['message'],
        ], $orderId);

        //$this->mailer->to($user->email)->send(new SuccessfulRegistration($user));
    }

    /**
     * @return void
     */
    public function forget(): void
    {
        $this->service->forget();
    }
}
