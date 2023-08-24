<?php

namespace App\Api;

use App\Model\BinList;
use GuzzleHttp\Client;

class BinListProvider implements BinProviderInterface
{

    const URL = 'https://lookup.binlist.net';

    public function __construct(public $client = new Client()) {
    }

    public function getBinList(?string $bin): mixed
    {
        $response = $this->client->get(BinListProvider::URL . '/' . $bin ?? '', ['headers' => ['Accept-Version' => 3]]);
        return BinList::fromJson($response->getBody());
    }
}
