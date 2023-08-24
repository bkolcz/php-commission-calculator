<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\ExchangeRateIo;
use PHPUnit\Framework\TestCase;

final class ExchangeRateIoTest extends TestCase
{
    public function testCreation(): void
    {
        $exchangeRate = new ExchangeRateIo(
            true,
            1692869943,
            "EUR",
            "2023-08-24",
            [
                "AED" => 3.98519,
                "AFN" => 90.550274
            ]
        );
        $this->assertEquals(true, $exchangeRate->success);
        $this->assertEquals(1692869943, $exchangeRate->timestamp);
        $this->assertEquals("EUR", $exchangeRate->base);
        $this->assertEquals("2023-08-24", $exchangeRate->date);
        $this->assertEquals([
            "AED" => 3.98519,
            "AFN" => 90.550274
        ], $exchangeRate->rateMap);
    }

    public function testCreationFromJson(): void
    {
        $exchangeRate = ExchangeRateIo::fromJson('{
            "success": true,
            "timestamp": 1692869943,
            "base": "EUR",
            "date": "2023-08-24",
            "rates": {
                "AED": 3.98519,
                "AFN": 90.550274
            }
        }');
        $this->assertEquals(true, $exchangeRate->success);
        $this->assertEquals(1692869943, $exchangeRate->timestamp);
        $this->assertEquals("EUR", $exchangeRate->base);
        $this->assertEquals("2023-08-24", $exchangeRate->date);
        $this->assertEquals([
            "AED" => 3.98519,
            "AFN" => 90.550274
        ], $exchangeRate->rateMap);
    }
}
