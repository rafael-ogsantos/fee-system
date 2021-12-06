<?php

namespace App\Outsource;

use Illuminate\Support\Facades\Http;

class ApiCurrency
{
    public static function currencyConverter($currency = 'USD-BRL'): array
    {
        $cities = Http::get("https://economia.awesomeapi.com.br/last/{$currency}");
        return $cities->json();
    }
}
