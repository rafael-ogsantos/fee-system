<?php

namespace App\Rates\ConvertedCurrency;

use App\PaymentInformations;

class ForValueBelow2700 extends Rate
{
    /**
     * @param PaymentInformations $paymentInformations
     * @return float
     */
    public function calculate(PaymentInformations $paymentInformations): float
    {
        if($paymentInformations->value < 2700) {
            return $paymentInformations->value * 2 / 100;
        }

        return $this->nextRate->calculate($paymentInformations);
    }
}
