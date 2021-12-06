<?php

namespace App\Rates\PaymentsMethods;

use App\PaymentInformations;

interface Rate
{
    public function calculate(PaymentInformations $paymentInformations): float;
}
