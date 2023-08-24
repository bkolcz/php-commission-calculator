<?php
declare(strict_types=1);

namespace App\Tests\Api;

use App\Api\ExchangeRateIoProvider;
use App\Api\ExchangeRateProviderInterface;
use App\Model\ExchangeRateIo;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class ExchangeRateIoProviderTest extends TestCase {
    
    function testOriginInstance(): void
    {
        $exchangeRateProvider = new ExchangeRateIoProvider();
        $this->assertInstanceOf(ExchangeRateProviderInterface::class, $exchangeRateProvider);
    }
    function testgetExchangeRates(): void
    {
        $mockResponse = file_get_contents(dirname(__DIR__, 2) . '/resources/exchange-rates-response.json');
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('__toString')->willReturn($mockResponse);
        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($stream);
        $client = $this->createMock(Client::class);
        $client
            ->expects($this->once())
            ->method('get')
            ->willReturn($response);
        $exchangeRateProvider = new ExchangeRateIoProvider('',$client);
        $this->assertInstanceOf(ExchangeRateIo::class, $exchangeRateProvider->getExchangeRates());
    }
}