<?php

declare(strict_types=1);

namespace App\Tests\Pattern;

use App\Pattern\Pattern;
use PHPUnit\Framework\TestCase;

final class PatternTest extends TestCase
{
    public function testEuPattern(): void
    {
        $pattern = new Pattern();
        $euArray = [
            'AT',
            'BE',
            'BG',
            'CY',
            'CZ',
            'DE',
            'DK',
            'EE',
            'ES',
            'FI',
            'FR',
            'GR',
            'HR',
            'HU',
            'IE',
            'IT',
            'LT',
            'LU',
            'LV',
            'MT',
            'NL',
            'PO',
            'PT',
            'RO',
            'SE',
            'SI',
            'SK'
        ];
        foreach($euArray as $country) {
            $this->assertEquals(1,preg_match($pattern->getEuPattern(),$country));
        }
        
        $this->assertEquals(0,preg_match($pattern->getEuPattern(),'JP'));
    }
}
