<?php

namespace App\Model;

class Bank
{
    function __construct(
        public ?string $name,
        public ?string $url,
        public ?string $phone,
        public ?string $city
    ) {
    }

    static function fromMap(mixed $map): Bank
    {
        return new Bank(
            array_key_exists('name', $map) ? $map['name'] : null,
            array_key_exists('url', $map) ? $map['url'] : null,
            array_key_exists('phone', $map) ? $map['phone'] : null,
            array_key_exists('city', $map) ? $map['city'] : null,
        );
    }
}
