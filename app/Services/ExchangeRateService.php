<?php

namespace App\Services;

use GuzzleHttp\Client;
use const App\Helpers\COUNTRY_CURRENCIES;

class ExchangeRateService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchExchangeRateData($countryID)
    {
        $countryCode = $countryID;
        $api_key = 'a69e5569ff304d949e2648ec76daaf03';

        //FIXME - Bellow is from crashed dashboard of exchangeratesapi.io
        //$api_key = '976c9a09692f812e3412ed7061c6415d';

        $client = new Client();
        $response = $client->get("https://openexchangerates.org/api/latest.json?app_id={$api_key}");

        $data = json_decode($response->getBody(), true);

        if (empty($data)) {
            return ['error' => 'Failed to fetch Exchange Rate response'];
        }

        $currencyList = config('currency');
        $currencyCode = $currencyList[$countryID];
        $getRate = $data['rates'][$currencyCode];

        return [
            'rate' => $getRate,
            'rateName' => $currencyCode
        ];
    }
}
