<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneRequest;
use App\UseCases\Auth\PhoneService;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\PhoneVerifyRequest;

class PhoneController extends Controller
{
    private $service;

    public function __construct(PhoneService $service)
    {
        $this->service = $service;
    }

    public function verify(PhoneRequest $request)
    {
        $phone = $request->input('phone');

        try {
            dd($this->service->request($phone));
        } catch (\DomainException $e) {
            //return redirect()->route('cabinet.profile.phone')->with('error', $e->getMessage());
            echo $e->getMessage();
        }
    }
}
