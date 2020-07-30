<?php


namespace App\Services\Acquiring;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;

class Rshb
{
    /**
     * API
     */
    const API = 'belaya.stroyka-api';

    private $password;

    const DEV_PASSWORD = 'belaya.stroyka';

    const PROD_PASSWORD = '';

    /** @var HttpClient $httpClient */
    private $httpClient;

    /**
     * Rshb constructor.
     */
    public function __construct()
    {
        $this->password = $this->password = config('app.debug') ? self::DEV_PASSWORD : self::PROD_PASSWORD;
        $this->httpClient = new HttpClient([
            'base_uri' => config('app.debug') ? 'https://web.rbsuat.com' : ''
        ]);
    }
    public function orderRegistration($orderId, $amount, $confirmOrderPaymentCode, $cancelOrderPaymentCode)
    {
        $amount = ((int)$amount * 100) + ($amount - (int)$amount);

        try {

            $response = $this->httpClient->post('/rshb/payment/rest/register.do', [
                'allow_redirects' => true,
                'port' => 443,
                RequestOptions::FORM_PARAMS => [
                    'userName' => self::API,
                    'password' => $this->password,
                    'orderNumber' => $orderId,
                    'amount' => $amount,
                    'returnUrl' => route('order.confirm_payment', ['confirmOrderPaymentCode' => $confirmOrderPaymentCode]),
                    'failUrl' => route('order.cancel_payment', ['cancelOrderPaymentCode' => $cancelOrderPaymentCode]),
                ]
            ]);
        }
        catch (ServerException $e) {
            return false;
        }

        return json_decode($response->getBody()->getContents(), true);
    }

}
