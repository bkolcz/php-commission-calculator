<?php

namespace App\Model;

class Country
{
    public function __construct(
        public ?string $numeric,
        public ?string $alpha,
        public ?string $name,
        public ?string $emoji,
        public ?string $currency,
        public ?int $latitude,
        public ?int $longtitude
    ) {
    }
    static function fromMap(mixed $map): Country
    {
        return new Country(
            array_key_exists('numeric', $map) ? $map['numeric'] : null,
            array_key_exists('alpha2', $map) ? $map['alpha2'] : null,
            array_key_exists('name', $map) ? $map['name'] : null,
            array_key_exists('emoji', $map) ? $map['emoji'] : null,
            array_key_exists('currency', $map) ? $map['currency'] : null,
            array_key_exists('latitude', $map) ? $map['latitude'] : null,
            array_key_exists('longitude', $map) ? $map['longitude'] : null,
        );
    }
}
