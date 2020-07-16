<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneRequest;
use App\UseCases\Auth\PhoneService;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\PhoneVerifyRequest;

class PhoneController extends Controller
{
    /**
     * @var array
     */
    private $data = [];
    private $service;

    public function __construct(PhoneService $service)
    {
        $this->service = $service;
    }

    public function request(PhoneRequest $request, Carbon $now)
    {
        $phone = $request->input('phone');

        if (is_null(session('phone'))) {
            session(['phone' => $phone]);
        }

        $this->data['result'] = $this->service->request($phone);
        $this->data['view'] = view('auth.phoneVerify', $this->data)->render();

        return response()->json($this->data);

    }

    public function verify(Request $request)
    {
        $this->service->verify();
    }
}
