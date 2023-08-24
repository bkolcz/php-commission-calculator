<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Bank;
use PHPUnit\Framework\TestCase;


final class BankTest extends TestCase
{
    public function testCreation(): void
    {
        $bank = new Bank('anonym', 'example.com', '+48555444333', 'Warsaw');
        $this->assertEquals('anonym', $bank->name);
        $this->assertEquals('example.com', $bank->url);
        $this->assertEquals('+48555444333', $bank->phone);
        $this->assertEquals('Warsaw', $bank->city);
    }

    public function testCreationFromMap(): void
    {
        $map = [
            'name' => 'anonym',
            'url' => 'example.com',
            'phone' => '+48555444333',
            'city' => 'Warsaw'
        ];
        $bank = Bank::fromMap($map);
        $this->assertEquals('anonym', $bank->name);
        $this->assertEquals('example.com', $bank->url);
        $this->assertEquals('+48555444333', $bank->phone);
        $this->assertEquals('Warsaw', $bank->city);
    }
}
