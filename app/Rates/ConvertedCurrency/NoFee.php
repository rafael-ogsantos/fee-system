<?php

namespace App\Rates\ConvertedCurrency;

use App\PaymentInformations;

class NoFee extends Rate
{
    public function __construct()
    {
        parent::__construct(null);
    }

    public function calculate(PaymentInformations $paymentInformations): float
    {
        return 0;
    }
}
