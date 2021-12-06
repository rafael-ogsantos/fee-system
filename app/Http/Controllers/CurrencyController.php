<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use App\Outsource\ApiCurrency;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function index()
    {
        return ApiCurrency::currencyConverter();
    }

    public function convertCurrency(Request $request)
    {
        $rules = [
            'currencyDestination' => 'required',
            'value' => 'required',
            'paymentMethod' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $currency = new Currency;

        if (!$currency->existsCurrency($request->currencyDestination)
            or !$currency->existsPaymentsMethod($request->paymentMethod)) {
            return response()->json(['error' => 'Informações não correspondem']);
        }

        $data = $currency->setData($request->currencyDestination)->getData();

        $conversionRate = $currency->conversionRate($request->value);
        $paymentMethodRate = $currency->paymentMethodRate($request->paymentMethod, $request->value);

        $convertedValue = $currency->generateConversionWithSumFees($request->value);

        $arrData = [
            'convertedValue' => $convertedValue,
            'currency' => $currency->replaceIfen($request->currencyDestination),
            'destinationCurrencyValue' => round($data['bid'], 2),
            'payRate' => round($paymentMethodRate, 2),
            'conversionRate' => round($conversionRate, 2)
        ];

        return response()->json($arrData);


    }
}
