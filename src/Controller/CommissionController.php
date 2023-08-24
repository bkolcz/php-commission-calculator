<?php

namespace App\Controller;

use App\Api\BinProviderInterface;
use App\Api\ExchangeRateProviderInterface;
use App\Model\BinList;
use App\Model\ExchangeRateIo;
use App\Model\Transaction;
use App\Pattern\PatternInterface;

class CommissionController
{

    public function __construct(
        private ExchangeRateProviderInterface $exchangeRateProvider,
        private BinProviderInterface $binProvider,
        private PatternInterface $pattern
    ) {
    }
    public function getCommissionRatesFromFile(string $path)
    {
        $exchangeRates = $this->exchangeRateProvider->getExchangeRates();
        $fileHandler = fopen($path, 'r');
        foreach ($this->getFileLineByLine($fileHandler) as $line) {
            $transaction = Transaction::fromJson($line);
            $binList = $this->binProvider->getBinList($transaction->bin);
            if ($binList->country === null) {
                continue;
            }
            printf("%.02f\n", $this->getCommisionRate($transaction, $binList, $exchangeRates));
        }
    }
    public function getCommisionRate(Transaction &$transaction, BinList &$binList, ExchangeRateIo &$exchangeRates): float
    {
        $matches = null;
        $rate = $exchangeRates->rateMap[$transaction->currency];
        $isEu = boolval(preg_match($this->pattern->getEuPattern(), $binList->country->alpha, $matches));
        $commission = $isEu ? 0.01 : 0.02;
        $fixedAmount = 0;
        if ($transaction->currency === 'EUR' || $rate === 0) {
            $fixedAmount = $transaction->amount;
        }
        if ($transaction->currency !== 'EUR' && $rate > 0) {
            $fixedAmount = $transaction->amount / $rate;
        }
        return $this->preciseCeil($commission * $fixedAmount, 2);
    }

    private function getFileLineByLine($fileHandler)
    {
        while (!feof($fileHandler)) {
            yield fgets($fileHandler);
        }
    }

    private function preciseCeil(float $value, int $precision): float
    {
        $pow = pow(10, $precision);
        $powValue = $pow * $value;
        return ceil($powValue) / $pow;
    }
}
