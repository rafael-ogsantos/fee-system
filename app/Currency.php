<?php

namespace App;

use App\Outsource\ApiCurrency;

class Currency
{
    const COINS = ['BRL-USD', 'BRL-EUR'];
    const METHODS_PAYMENTS = ['BANK-SLIP', 'CREDIT-CARD'];

    /**
     * currency information informed
     * @var array $data
     */
    private array $data;

    /**
     * values of each fee on top of the value
     * @var array $fees;
     */
    private array $fees;

    /**
     * @param array $coins
     * @return bool
     */
    public function existsCurrency(string $coins): bool
    {
        return in_array($coins, self::COINS);
    }

    /**
     * @param array $paymentMethod
     * @return bool
     */
    public function existsPaymentsMethod(string $paymentMethod): bool
    {
        return in_array($paymentMethod, self::METHODS_PAYMENTS);
    }

    /**
     * @param string $currencyDestination
     * @return Currency
     */
    public function setData(string $currencyDestination): Currency
    {
        $currencyName = $this->replaceIfen($currencyDestination);
        $this->data = ApiCurrency::currencyConverter($currencyDestination)[$currencyName];

        return $this;
    }

    /**
     * @param float $value
     * @return float
     */
    public function conversionRate(float $value): float
    {
        $rateCalculate = new RateCalculate();
        $paymentInformations = new PaymentInformations();
        $paymentInformations->value =  $value;

        $fees = $rateCalculate->calculate($paymentInformations) / 100;
        $this->fees['rateConversion'] = $fees;
        return $fees;
    }

    /**
     * @param string $paymentMethod
     * @param float $value
     * @return float
     */
    public function paymentMethodRate(string $paymentMethod, float $value): float
    {
        $paymentInformations = new PaymentInformations();
        $paymentInformations->value = $value;
        $calcula = new RateConvertedCurrency();

        $name = $this->refactoryName($paymentMethod);

        $class = "App\Rates\PaymentsMethods\\$name";
        $paymentInformations->paymentMethod = $class;
        $fees = $calcula->calcula($paymentInformations, new $class) / 100;
        $this->fees['paymentMethodRate'] = $fees;
        return $fees;
    }

    /**
     * @param float $value
     * @return float
     */
    public function generateConversionWithSumFees(float $value): float
    {
        $conversionRate = ($value + $this->fees['rateConversion'] + $this->fees['paymentMethodRate']) * round($this->data['bid'], 2);
        $conversionRate = round($conversionRate, 2);
        return $conversionRate;
    }

    /**
     * @param string $phrase
     * @return string
     */
    public function replaceIfen(string $phrase): string
    {
        return str_replace('-', '', $phrase);
    }

    /**
     * @param string $name
     * @return string
     */
    private function refactoryName(string $name): string
    {
        $explodeIfen = explode('-', strtolower($name));
        $name = ucfirst($explodeIfen[0]) . ucfirst($explodeIfen[1]);
        return $name;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
