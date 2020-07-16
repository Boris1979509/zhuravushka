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
        //$this->sms->send($user->phone, 'Phone verification token: ' . $token); // Send ...
        if ($token = $this->getToken(Carbon::now())) {
            return [
                'status'  => 'success',
                'message' => 'verification token: ' . $token
            ];
        }
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

        if (is_null(session('expireToken'))) {
            session(['expireToken' => $expire_token, 'token' => $phone_verify_token]);
            return $phone_verify_token;
        }
        if (session('expireToken') && session('expireToken') > $now->timestamp) {
            return 'Token is already requested.';
            // throw new \DomainException('Token is already requested.');
        }
        session()->forget('expireToken');
    }
    public function verify(){

    }

}
