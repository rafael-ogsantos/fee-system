<?php

namespace App;

use App\Rates\PaymentsMethods\Rate;

class RateConvertedCurrency
{
    /** @param PaymentInformations $paymentInformations
     *  @param Rate $rate
     *  @return float
     */
    public function calcula(PaymentInformations $paymentInformations, Rate $rate): float
    {
        return $rate->calculate($paymentInformations);
    }
}
