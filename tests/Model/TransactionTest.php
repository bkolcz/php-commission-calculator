<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Transaction;
use PHPUnit\Framework\TestCase;

final class TransactionTest extends TestCase
{
    public function testCreation(): void
    {
        $transaction = new Transaction("45717360", 100.00, "EUR");
        $this->assertEquals("45717360", $transaction->bin);
        $this->assertEquals(100, $transaction->amount);
        $this->assertEquals("EUR", $transaction->currency);
    }

    public function testCreationFromJson(): void
    {
        $transaction = Transaction::fromJson('{"bin":"45717360","amount":"100.00","currency":"EUR"}');
        $this->assertEquals("45717360", $transaction->bin);
        $this->assertEquals(100, $transaction->amount);
        $this->assertEquals("EUR", $transaction->currency);
    }
}
