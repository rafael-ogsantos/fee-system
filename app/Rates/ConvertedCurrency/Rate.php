<?php

namespace App\Rates\ConvertedCurrency;

use App\PaymentInformations;

abstract class Rate
{
    protected ?Rate $nextRate;

    public function __construct(?Rate $nextRate)
    {
        $this->nextRate = $nextRate;
    }

    abstract public function calculate(PaymentInformations $paymentInformations): float;
}
