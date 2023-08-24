<?php

namespace App;

use App\Api\ExchangeRateProviderInterface;
use App\Api\BinProviderInterface;
use App\Pattern\PatternInterface;
use App\Controller\CommissionController;

class Kernel
{
    public function __construct(
        private ExchangeRateProviderInterface $exchangeRateProvider,
        private BinProviderInterface $binProvider,
        private PatternInterface $pattern,
        private string $filepath
    ) {
    }
    public function run()
    {
        (new CommissionController(
            $this->exchangeRateProvider,
            $this->binProvider,
            $this->pattern
        ))->getCommissionRatesFromFile($this->filepath);
    }
}
