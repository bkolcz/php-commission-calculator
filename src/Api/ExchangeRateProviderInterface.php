<?php

namespace App\Api;

interface ExchangeRateProviderInterface
{
    public function getExchangeRates(): mixed;
}
