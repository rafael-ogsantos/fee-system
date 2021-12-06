<?php

namespace App\Rates\ConvertedCurrency;

use App\PaymentInformations;

class ForValueLessThan4000 extends Rate
{
    /**
     * @param PaymentInformations $paymentInformations
     * @return float
     */
    public function calculate(PaymentInformations $paymentInformations): float
    {
        if($paymentInformations->value > 4000) {
            return $paymentInformations->value * 1 / 100;
        }

        return $this->nextRate->calculate($paymentInformations);
    }
}
