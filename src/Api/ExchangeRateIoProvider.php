<?php

namespace App\Api;

use App\Model\ExchangeRateIo;
use GuzzleHttp\Client;

class ExchangeRateIoProvider implements ExchangeRateProviderInterface
{

    const URL = 'http://api.exchangeratesapi.io';
    public function __construct(public ?string $accessKey = null)
    {
    }
    public function getExchangeRates(): mixed
    {
        $client = new Client();
        $response = $client->get(ExchangeRateIoProvider::URL . '/latest', [
            'query' => $this->accessKey === null ? [] : ['access_key' => $this->accessKey]
        ]);
        return ExchangeRateIo::fromJson($response->getBody());
    }
}
