<?php
declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Bank;
use App\Model\BinList;
use App\Model\BinNumber;
use App\Model\Country;
use PHPUnit\Framework\TestCase;

final class BinListTest extends TestCase {
    public function testCreation(): void
    {
        $binNumber = new BinNumber(16,true);
        $country = new Country("440","LT","Lithuania","🇱🇹","EUR",56,24);
        $bank = new Bank('anonym', 'example.com', '+48555444333', 'Warsaw');
        $binList = new BinList($binNumber,"mastercard","debit","Debit",$country,$bank,true);
        
        $this->assertEquals('anonym', $binList->bank->name);
        $this->assertEquals('example.com', $binList->bank->url);
        $this->assertEquals('+48555444333', $binList->bank->phone);
        $this->assertEquals('Warsaw', $binList->bank->city);
        $this->assertEquals("440", $binList->country->numeric);
        $this->assertEquals("LT", $binList->country->alpha);
        $this->assertEquals("Lithuania", $binList->country->name);
        $this->assertEquals("🇱🇹", $binList->country->emoji);
        $this->assertEquals("EUR", $binList->country->currency);
        $this->assertEquals(56, $binList->country->latitude);
        $this->assertEquals(24, $binList->country->longtitude);
        $this->assertEquals(16, $binList->number->length);
        $this->assertEquals(true, $binList->number->luhn);
        $this->assertEquals("mastercard",$binList->scheme);
        $this->assertEquals("debit",$binList->type);
        $this->assertEquals("Debit",$binList->brand);
        $this->assertEquals(true,$binList->prepaid);
    }

    public function testCreationFromJson(): void
    {
        $json = '{
            "number": {
                "length": 16,
                "luhn": true
            },
            "scheme": "mastercard",
            "type": "debit",
            "brand": "Debit",
            "country": {
                "numeric": "440",
                "alpha2": "LT",
                "name": "Lithuania",
                "emoji": "🇱🇹",
                "currency": "EUR",
                "latitude": 56,
                "longitude": 24
            },
            "bank": {
                "name": "anonym",
                "url": "example.com",
                "phone": "+48555444333",
                "city": "Warsaw"
            },
            "prepaid" : true
        }';
        $binList = BinList::fromJson($json);

        $this->assertEquals('anonym', $binList->bank->name);
        $this->assertEquals('example.com', $binList->bank->url);
        $this->assertEquals('+48555444333', $binList->bank->phone);
        $this->assertEquals('Warsaw', $binList->bank->city);
        $this->assertEquals("440", $binList->country->numeric);
        $this->assertEquals("LT", $binList->country->alpha);
        $this->assertEquals("Lithuania", $binList->country->name);
        $this->assertEquals("🇱🇹", $binList->country->emoji);
        $this->assertEquals("EUR", $binList->country->currency);
        $this->assertEquals(56, $binList->country->latitude);
        $this->assertEquals(24, $binList->country->longtitude);
        $this->assertEquals(16, $binList->number->length);
        $this->assertEquals(true, $binList->number->luhn);
        $this->assertEquals("mastercard",$binList->scheme);
        $this->assertEquals("debit",$binList->type);
        $this->assertEquals("Debit",$binList->brand);
        $this->assertEquals(true,$binList->prepaid);
    }
}