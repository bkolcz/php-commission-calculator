<?php

namespace App\Model;

class BinList
{
    function __construct(
        public ?BinNumber $number,
        public ?string $scheme,
        public ?string $type,
        public ?string $brand,
        public ?Country $country,
        public ?Bank $bank,
        public ?bool $prepaid
    ) {
    }

    static function fromJson(string $json): BinList
    {
        $map = json_decode($json, true);
        $map['number'] = array_key_exists('number', $map) ? BinNumber::fromMap($map['number']) : null;
        $map['scheme'] = array_key_exists('scheme', $map) ? $map['scheme'] : null;
        $map['type'] = array_key_exists('type', $map) ? $map['type'] : null;
        $map['brand'] = array_key_exists('brand', $map) ? $map['brand'] : null;
        $map['country'] = array_key_exists('country', $map) ? Country::fromMap($map['country']) : null;
        $map['bank'] = array_key_exists('bank', $map) ? Bank::fromMap($map['bank']) : null;
        $map['prepaid'] = array_key_exists('prepaid', $map) ? $map['prepaid'] : null;
        return new BinList(
            $map['number'],
            $map['scheme'],
            $map['type'],
            $map['brand'],
            $map['country'],
            $map['bank'],
            $map['prepaid']
        );
    }
}
