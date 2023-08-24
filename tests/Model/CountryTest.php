<?php
declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Country;
use PHPUnit\Framework\TestCase;

final class CountryTest extends TestCase {
    public function testCreation(): void
    {
        $country = new Country("440","LT","Lithuania","🇱🇹","EUR",56,24);
        $this->assertEquals("440", $country->numeric);
        $this->assertEquals("LT", $country->alpha);
        $this->assertEquals("Lithuania", $country->name);
        $this->assertEquals("🇱🇹", $country->emoji);
        $this->assertEquals("EUR", $country->currency);
        $this->assertEquals(56, $country->latitude);
        $this->assertEquals(24, $country->longtitude);
    }

    public function testCreationFromMap(): void
    {
        $map = json_decode('{
            "numeric": "440",
            "alpha2": "LT",
            "name": "Lithuania",
            "emoji": "🇱🇹",
            "currency": "EUR",
            "latitude": 56,
            "longitude": 24
        }',true);
        $country = Country::fromMap($map);
        $this->assertEquals("440", $country->numeric);
        $this->assertEquals("LT", $country->alpha);
        $this->assertEquals("Lithuania", $country->name);
        $this->assertEquals("🇱🇹", $country->emoji);
        $this->assertEquals("EUR", $country->currency);
        $this->assertEquals(56, $country->latitude);
        $this->assertEquals(24, $country->longtitude);
    }
}