<?php

namespace App\Model;

class ExchangeRateIo
{
    public function __construct(
        public ?bool $success, 
        public ?int $timestamp,
        public ?string $base,
        public ?string $date,
        public mixed $rateMap
    ) {
    }

    static function fromJson(string $json): ExchangeRateIo
    {
        $map = json_decode($json, true);
        $map['success'] = array_key_exists('success', $map) ?: null;
        $map['timestamp'] = array_key_exists('timestamp', $map) ?: null;
        $map['base'] = array_key_exists('base', $map) ?: null;
        $map['date'] = array_key_exists('date', $map) ?: null;
        $map['rates'] = array_key_exists('rates', $map) ?: null;
        return new ExchangeRateIo(
            $map['success'],
            $map['timestamp'],
            $map['base'],
            $map['date'],
            $map['rates']
        );
    }
}
