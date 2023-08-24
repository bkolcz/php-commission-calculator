<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Api\BinProviderInterface;
use App\Api\ExchangeRateProviderInterface;
use App\Controller\CommissionController;
use App\Model\Transaction;
use App\Model\BinList;
use App\Model\ExchangeRateIo;
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

        $lines = [
            '{"bin":"45717360","amount":"100.00","currency":"EUR"}' . "\n",
            '{"bin":"516793","amount":"50.00","currency":"USD"}'. "\n",
            '{"bin":"45417360","amount":"10000.00","currency":"JPY"}'. "\n",
            '{"bin":"41417360","amount":"130.00","currency":"USD"}'. "\n",
            '{"bin":"4745030","amount":"2000.00","currency":"GBP"}'
        ];
        $fileToTest = fopen(dirname(__DIR__, 2) . '/resources/input.txt','r');
        $fileLineByLine = self::getMethod('getFileLineByLine', $commissionController);
        foreach($fileLineByLine->invokeArgs($commissionController, [$fileToTest]) as $key => $line) {
            $this->assertEquals($lines[$key], $line);
        }
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
        $transaction = Transaction::fromJson('{"bin":"45717360","amount":"100.00","currency":"EUR"}');
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
        $exchangeRate = ExchangeRateIo::fromJson('{
            "success": true,
            "timestamp": 1692869943,
            "base": "EUR",
            "date": "2023-08-24",
            "rates": {
                "AED": 3.98519,
                "AFN": 90.550274,
                "ALL": 107.834442,
                "AMD": 416.440472,
                "ANG": 1.94437,
                "AOA": 902.172207,
                "ARS": 379.744302,
                "AUD": 1.682926,
                "AWG": 1.955679,
                "AZN": 1.851166,
                "BAM": 1.952302,
                "BBD": 2.177747,
                "BDT": 118.078451,
                "BGN": 1.952915,
                "BHD": 0.40901,
                "BIF": 3059.275397,
                "BMD": 1.084981,
                "BND": 1.465801,
                "BOB": 7.454404,
                "BRL": 5.270511,
                "BSD": 1.078544,
                "BTC": 4.101369e-5,
                "BTN": 89.258206,
                "BWP": 14.579283,
                "BYN": 2.723097,
                "BYR": 21265.63051,
                "BZD": 2.174154,
                "CAD": 1.469688,
                "CDF": 2697.263016,
                "CHF": 0.955653,
                "CLF": 0.033793,
                "CLP": 932.465064,
                "CNY": 7.896926,
                "COP": 4427.808067,
                "CRC": 580.775541,
                "CUC": 1.084981,
                "CUP": 28.752,
                "CVE": 110.668525,
                "CZK": 24.13085,
                "DJF": 192.046104,
                "DKK": 7.454515,
                "DOP": 61.532672,
                "DZD": 148.048901,
                "EGP": 33.418613,
                "ERN": 16.274717,
                "ETB": 59.646886,
                "EUR": 1,
                "FJD": 2.450918,
                "FKP": 0.853418,
                "GBP": 0.855578,
                "GEL": 2.842891,
                "GGP": 0.853418,
                "GHS": 12.336049,
                "GIP": 0.853418,
                "GMD": 66.032034,
                "GNF": 9385.087191,
                "GTQ": 8.471549,
                "GYD": 225.698358,
                "HKD": 8.507809,
                "HNL": 27.053992,
                "HRK": 7.467709,
                "HTG": 146.719841,
                "HUF": 383.422592,
                "IDR": 16541.622589,
                "ILS": 4.0939,
                "IMP": 0.853418,
                "INR": 89.593942,
                "IQD": 1412.968526,
                "IRR": 45853.993764,
                "ISK": 143.097775,
                "JEP": 0.853418,
                "JMD": 166.995429,
                "JOD": 0.768276,
                "JPY": 157.758967,
                "KES": 157.21409,
                "KGS": 95.66431,
                "KHR": 4498.33219,
                "KMF": 491.933435,
                "KPW": 976.455395,
                "KRW": 1432.066414,
                "KWD": 0.334511,
                "KYD": 0.898994,
                "KZT": 498.259615,
                "LAK": 21010.65987,
                "LBP": 16556.812062,
                "LKR": 349.558564,
                "LRD": 201.670905,
                "LSL": 20.234641,
                "LTL": 3.203667,
                "LVL": 0.656295,
                "LYD": 5.235056,
                "MAD": 10.860405,
                "MDL": 19.257032,
                "MGA": 4855.290441,
                "MKD": 61.481432,
                "MMK": 2265.072175,
                "MNT": 3773.219907,
                "MOP": 8.713689,
                "MRO": 387.338083,
                "MUR": 49.377357,
                "MVR": 16.719421,
                "MWK": 1170.151985,
                "MXN": 18.275119,
                "MYR": 5.039751,
                "MZN": 68.625004,
                "NAD": 20.234747,
                "NGN": 839.227107,
                "NIO": 39.694005,
                "NOK": 11.577801,
                "NPR": 142.822069,
                "NZD": 1.825465,
                "OMR": 0.417701,
                "PAB": 1.078832,
                "PEN": 4.0133,
                "PGK": 3.824558,
                "PHP": 61.546674,
                "PKR": 324.949499,
                "PLN": 4.476634,
                "PYG": 7844.319392,
                "QAR": 3.950424,
                "RON": 4.934606,
                "RSD": 117.274584,
                "RUB": 102.393472,
                "RWF": 1290.585076,
                "SAR": 4.070057,
                "SBD": 9.073176,
                "SCR": 14.408015,
                "SDG": 651.751404,
                "SEK": 11.913637,
                "SGD": 1.469168,
                "SHP": 1.320151,
                "SLE": 23.660151,
                "SLL": 21428.377934,
                "SOS": 617.354127,
                "SSP": 652.614359,
                "SRD": 41.466878,
                "STD": 22456.919205,
                "SYP": 14212.992404,
                "SZL": 20.234836,
                "THB": 37.963687,
                "TJS": 11.839987,
                "TMT": 3.797434,
                "TND": 3.339029,
                "TOP": 2.589955,
                "TRY": 29.534818,
                "TTD": 7.325909,
                "TWD": 34.440122,
                "TZS": 2717.877964,
                "UAH": 39.850805,
                "UGX": 4005.694183,
                "USD": 1.084981,
                "UYU": 40.815558,
                "UZS": 13111.997216,
                "VEF": 3460178.904663,
                "VES": 34.869452,
                "VND": 26039.547563,
                "VUV": 131.72821,
                "WST": 2.962024,
                "XAF": 654.801963,
                "XAG": 0.044953,
                "XAU": 0.000565,
                "XCD": 2.932216,
                "XDR": 0.811269,
                "XOF": 656.952855,
                "XPF": 119.67653,
                "YER": 271.56968,
                "ZAR": 20.247483,
                "ZMK": 9766.124973,
                "ZMW": 20.979063,
                "ZWL": 349.363487
            }
        }');
        $commissionRate = $commissionController->getCommisionRate($transaction,$binList,$exchangeRate);
        $this->assertEquals(2.0,$commissionRate);
    }

    /**
     * This test is not needed as it would only add redundancy
     * 
     * @doesNotPerformAssertions
     */
    public function testGetCommissionRatesFromFile(): void
    {
    }
}
