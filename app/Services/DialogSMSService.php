<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DialogSMSService
{
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->username = env('SMS_USERNAME');
        $this->password = env('SMS_PASSWORD');
    }

    public function getToken()
    {
        return Cache::remember('dialog_sms_token', 11 * 60, function () {
            $response = Http::post('https://e-sms.dialog.lk/api/v1/login', [
                'username' => $this->username,
                'password' => $this->password
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                return $response->json('token');
            }

            throw new \Exception("Dialog SMS Auth Failed: " . $response->json('comment'));
        });
    }

    public function sendSMS($mobile, $message)
    {
        $token = $this->getToken();
        $transactionId = now()->timestamp . rand(1000, 9999); // simple unique ID

        $payload = [
            "msisdn" => [
                ["mobile" => ltrim($mobile, '0')] // should be 7XXXXXXXX
            ],
            "sourceAddress" => env('SMS_SOURCE_ADDRESS'), // use your mask here or leave blank
            "message" => $message,
            "transaction_id" => $transactionId
        ];

        $response = Http::withToken($token)
            ->post('https://e-sms.dialog.lk/api/v1/sms', $payload);

        if ($response->successful() && $response->json('status') === 'success') {
            return true;
        }

        throw new \Exception("SMS Failed: " . $response->json('comment'));
    }
}
