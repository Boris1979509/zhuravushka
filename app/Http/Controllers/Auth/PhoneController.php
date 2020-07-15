<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneRequest;
use App\UseCases\Auth\PhoneService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\PhoneVerifyRequest;

class PhoneController extends Controller
{
    private $service;

    public function __construct(PhoneService $service)
    {
        $this->service = $service;
    }

    public function verify(PhoneRequest $request, Carbon $now): void
    {
        $phone = $request->input('phone');

//      try {
        $token = $this->service->request($phone);

        if (is_null(session('expireToken'))) {
            session(['expireToken' => $token]);
        }
//        } catch (\DomainException $e) {
//            //return redirect()->route('cabinet.profile.phone')->with('error', $e->getMessage());
//            echo $e->getMessage();
//        }
    }
}
