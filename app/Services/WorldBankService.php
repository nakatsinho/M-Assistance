<?php

namespace App\Services;

use GuzzleHttp\Client;

class WorldBankService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchWorldBankData($countryCode)
    {
        $populationIndicator = 'SP.POP.TOTL';
        $perCapitaIndicator = 'NY.GDP.PCAP.CD';
        $apiKey = 'YOUR_WORLD_BANK_API_KEY'; 
        
        $populationResponse = $this->client->get("https://api.worldbank.org/v2/countries/{$countryCode}/indicators/{$populationIndicator}?format=json&per_page=1&date=2021&source=2&api_key={$apiKey}");
        $perCapitaResponse = $this->client->get("https://api.worldbank.org/v2/countries/{$countryCode}/indicators/{$perCapitaIndicator}?format=json&per_page=1&date=2021&source=2&api_key={$apiKey}");

        $populationData = json_decode($populationResponse->getBody(), true);
        $perCapitaData = json_decode($perCapitaResponse->getBody(), true);

        if (empty($populationData[1][0]) || empty($perCapitaData[1][0])) {
            return ['error' => 'Failed to fetch World Bank data'];
        }

        $populationValue = $populationData[1][0]['value'];
        $perCapitaValue = $perCapitaData[1][0]['value'];

        return [
            'population' => $populationValue,
            'per_capita' => $perCapitaValue,
        ];
    }
}
