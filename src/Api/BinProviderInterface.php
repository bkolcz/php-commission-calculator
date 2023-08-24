<?php

namespace App\Api;

interface BinProviderInterface
{
    public function getBinList(?string $bin): mixed;
}
