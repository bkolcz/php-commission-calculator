<?php

declare(strict_types=1);

namespace App\Tests\Api;

use App\Model\BinList;
use App\Api\BinListProvider;
use App\Api\BinProviderInterface;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class BinListProviderTest extends TestCase
{

    function testOriginInstance(): void
    {
        $binListProvider = new BinListProvider();
        $this->assertInstanceOf(BinProviderInterface::class, $binListProvider);
    }
    function testGetBinList(): void
    {
        $testArg = '516793';
        $mockResponse = file_get_contents(dirname(__DIR__, 2) . '/resources/binlist-516793.json');
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('__toString')->willReturn($mockResponse);
        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($stream);
        $client = $this->createMock(Client::class);
        $client
            ->expects($this->once())
            ->method('get')
            ->with(BinListProvider::URL . '/' . $testArg, ['headers' => ['Accept-Version' => 3]])
            ->willReturn($response);
        $binListProvider = new BinListProvider($client);
        $this->assertInstanceOf(BinList::class,$binListProvider->getBinList($testArg));
    }
}
