<?php

namespace App\Model;

class Transaction
{

    function __construct(
        public ?string $bin,
        public ?float $amount,
        public ?string $currency
    ) {
    }

    static function fromJson(string $json): Transaction
    {
        $map = json_decode($json, true);
        $map['bin'] = array_key_exists('bin', $map) ? $map['bin'] : null;
        $map['amount'] = array_key_exists('amount', $map) ? floatval($map['amount']) : null;
        $map['currency'] = array_key_exists('currency', $map) ? $map['currency'] : null;

        return new Transaction(
            $map['bin'],
            $map['amount'],
            $map['currency']
        );
    }
}
