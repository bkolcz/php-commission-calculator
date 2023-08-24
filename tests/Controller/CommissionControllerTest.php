<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Api\BinProviderInterface;
use App\Api\ExchangeRateProviderInterface;
use App\Controller\CommissionController;
use App\Pattern\PatternInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class CommissionControllerTest extends TestCase
{
    // TODO CommissionControllerTest 
    protected static function getMethod($name, $object)
    {
        $class = new ReflectionClass($object);
        return $class->getMethod($name);
    }

    public function testPreciseCeil(): void
    {
        $mockExchangeRateProvider = $this->createMock(ExchangeRateProviderInterface::class);
        $mockBinProvider = $this->createMock(BinProviderInterface::class);
        $mockPattern = $this->createMock(PatternInterface::class);
        $commissionController = new CommissionController(
            $mockExchangeRateProvider,
            $mockBinProvider,
            $mockPattern
        );
        $preciseCeil = self::getMethod('preciseCeil', $commissionController);
        $this->assertEquals(0.34, $preciseCeil->invokeArgs($commissionController, [0.330003, 2]));
    }

    public function testGetFileLineByLine(): void
    {
        $mockExchangeRateProvider = $this->createMock(ExchangeRateProviderInterface::class);
        $mockBinProvider = $this->createMock(BinProviderInterface::class);
        $mockPattern = $this->createMock(PatternInterface::class);
        $commissionController = new CommissionController(
            $mockExchangeRateProvider,
            $mockBinProvider,
            $mockPattern
        );
        // TODO LineByLine
    }

    public function testGetCommissionRate(): void
    {
        $mockExchangeRateProvider = $this->createMock(ExchangeRateProviderInterface::class);
        $mockBinProvider = $this->createMock(BinProviderInterface::class);
        $mockPattern = $this->createMock(PatternInterface::class);
        $commissionController = new CommissionController(
            $mockExchangeRateProvider,
            $mockBinProvider,
            $mockPattern
        );
        // TODO CommisionRate
    }

    public function testGetCommissionRatesFromFile(): void
    {
        $mockExchangeRateProvider = $this->createMock(ExchangeRateProviderInterface::class);
        $mockBinProvider = $this->createMock(BinProviderInterface::class);
        $mockPattern = $this->createMock(PatternInterface::class);
        $commissionController = new CommissionController(
            $mockExchangeRateProvider,
            $mockBinProvider,
            $mockPattern
        );
        // TODO CommissionRateFromFile
    }
}
