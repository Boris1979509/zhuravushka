<?php


namespace App\UseCases\Auth;

use App\Http\Requests\Auth\PhoneVerifyRequest;
use App\Services\Sms\SmsSender;
use App\Models\User;
use Illuminate\Http\Request;
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
        return $this->getToken(Carbon::now());
        //$this->sms->send($user->phone, 'Phone verification token: ' . $token); // Send ...
    }

    /**
     * @param Carbon $now
     * @return bool | array
     * @throws \Exception
     */
    private function getToken(Carbon $now)
    {
        if (session('attempts') <= 3) {
            $i = 0;
            $phone_verify_token = (string)random_int(1000, 9999);
            $expire_token = $now->copy()->addSeconds(60)->timestamp;

            if (session('expireToken') && session('expireToken') > $now->timestamp) {
                return ['status' => false, 'message' => 'Token is already requested.'];
            } else {
                $i = session('attempts'); // number of attempts
                session([
                    'expireToken' => $expire_token,
                    'token' => $phone_verify_token,
                    'attempts' => ++$i
                ]);
                return ['status' => true, 'token' => $phone_verify_token];
            }
        }
        return [
            'status' => false,
            'attempts' => true,
            'message' => 'The maximum number of attempts has been reached.',
        ];
    }

    /**
     * @param string $tokenClient
     * @return array|bool
     */
    public function verify($tokenClient)
    {
        if (session('token') === $tokenClient) {
            return [
                'status' => true,
            ];
        }
        return [
            'status' => false,
            'message' => 'Неверный код подтверждения.',
        ];
    }

}
