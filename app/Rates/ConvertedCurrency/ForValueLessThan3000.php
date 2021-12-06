<?php

namespace App\Rates\ConvertedCurrency;

use App\PaymentInformations;

class ForValueLessThan3000 extends Rate
{
    /**
     * @param PaymentInformations $paymentInformations
     * @return float
     */
    public function calculate(PaymentInformations $paymentInformations): float
    {
        if($paymentInformations->value < 3000) {
            return $paymentInformations->value * 2;
        }

        return $this->nextRate->calculate($paymentInformations);
    }
}
