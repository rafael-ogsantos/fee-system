<?php

namespace App\Rates\ConvertedCurrency;

use App\PaymentInformations;

class ForValueBelow3000 extends Rate
{
    public function calculate(PaymentInformations $paymentInformations): float
    {
        if($paymentInformations->value > 3000) {
            return $paymentInformations->value * 1;
        }

        return $this->nextRate->calculate($paymentInformations);
    }
}