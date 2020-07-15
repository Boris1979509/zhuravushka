<?php


namespace App\UseCases\Auth;

use App\Http\Requests\Auth\PhoneVerifyRequest;
use App\Services\Sms\SmsSender;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Carbon;

class PhoneService
{
    private $sms;

    public function __construct(/*SmsSender $sms*/)
    {
        //$this->sms = $sms;
    }

    public function request($phone)
    {
        return  $this->getToken(Carbon::now());
        //$this->sms->send($user->phone, 'Phone verification token: ' . $token);

        //return $token;
//        if (!session('expire_token')->gt($now)) {
//            throw new \DomainException('Token is already requested.');
//        }
//        if (cookie()->has('expire_token')) {
//            return session('expire_token') . ' | ' . Carbon::now();
//        }

        //return 'Phone ' . $phone . ' verification token: ' . $token;
    }

    /**
     * @param Carbon $now
     * @return string
     * @throws \Exception
     */
    private function getToken(Carbon $now): string
    {
        $phone_verify_token = (string)random_int(1000, 9999);
        $expire_token = $now->copy()->addSeconds(100)->timestamp;
        //session(['expire_token' => $expire_token]);
        return $expire_token;
    }

}
