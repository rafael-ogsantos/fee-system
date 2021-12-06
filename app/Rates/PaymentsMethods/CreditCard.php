<?php

namespace App\Rates\PaymentsMethods;

use App\PaymentInformations;

class CreditCard implements Rate
{
    /** @param PaymentInformations $paymentInformations
     *  @return float
    */
    public function calculate(PaymentInformations $paymentInformations): float
    {
        if($paymentInformations->paymentMethod == CreditCard::class) {
            return $paymentInformations->value * 7.65;
        }

        return 0;
    }
}
