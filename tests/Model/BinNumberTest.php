<?php
declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\BinNumber;
use PHPUnit\Framework\TestCase;

final class BinNumberTest extends TestCase {
    public function testCreation(): void
    {
        $binNumber = new BinNumber(16,true);
        $this->assertEquals(16, $binNumber->length);
        $this->assertEquals(true, $binNumber->luhn);
    }

    public function testCreationFromJson(): void
    {
        $map = json_decode('{
            "length": 16,
            "luhn": true
        }',true);
        $binNumber = BinNumber::fromMap($map);
        $this->assertEquals(16, $binNumber->length);
        $this->assertEquals(true, $binNumber->luhn);
    }


}