<?php

namespace App;

use App\Rates\ConvertedCurrency\ForValueBelow3000;
use App\Rates\ConvertedCurrency\ForValueLessThan3000;
use App\Rates\ConvertedCurrency\NoFee;

class RateCalculate
{
    /**
     * @param PaymentInformations $paymentInformations
     * @return float
     */
    public function calculate(PaymentInformations $paymentInformations): float
    {
        $rateChain = new ForValueBelow3000(
            new ForValueLessThan3000(
                new NoFee()
            )
        );

        return $rateChain->calculate($paymentInformations);
    }
}
