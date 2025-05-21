<?php

namespace App\Helpers;

class OnepayHelper
{
    public static function generateHash($currency, $amount)
    {
        $appId = config('onepay.app_id');
        $hashSalt = config('onepay.hash_salt');
        $formattedAmount = number_format($amount, 2, '.', '');
        $string = $appId . $currency . $formattedAmount . $hashSalt;
        return hash('sha256', $string);
    }
}
