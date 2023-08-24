<?php

namespace App\Model;

class BinNumber
{
    public function __construct(
        public ?int $length,
        public ?bool $luhn
    ) {
    }
    static function fromMap(mixed $map): BinNumber
    {
        return new BinNumber(
            array_key_exists('length', $map) ? $map['length'] : null,
            array_key_exists('luhn', $map) ? $map['luhn'] : null
        );
    }
}
