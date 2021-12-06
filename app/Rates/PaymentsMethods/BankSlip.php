<?php

namespace App\Rates\PaymentsMethods;

use App\PaymentInformations;

class BankSlip implements Rate
{
    /** @param PaymentInformations $paymentInformations
     *  @return float
    */
    public function calculate(PaymentInformations $paymentInformations): float
    {
        if($paymentInformations->paymentMethod == BankSlip::class) {
            return $paymentInformations->value * 1.45;
        }

        return 0;
    }
}
