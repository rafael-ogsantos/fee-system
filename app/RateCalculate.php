<?php

namespace App;

use App\Rates\ConvertedCurrency\ForValueBelow2700;
use App\Rates\ConvertedCurrency\ForValueLessThan4000;
use App\Rates\ConvertedCurrency\NoFee;

class RateCalculate
{
    /**
     * @param PaymentInformations $paymentInformations
     * @return float
     */
    public function calculate(PaymentInformations $paymentInformations): float
    {
        $rateChain = new ForValueBelow2700(
            new ForValueLessThan4000(
                new NoFee()
            )
        );

        return $rateChain->calculate($paymentInformations);
    }
}
