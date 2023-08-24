<?php

namespace App\Api;

use App\Model\BinList;
use GuzzleHttp\Client;

class BinListProvider implements BinProviderInterface
{

    const URL = 'https://lookup.binlist.net';

    public function getBinList(?string $bin): mixed
    {
        $client = new Client();
        $response = $client->get(BinListProvider::URL . '/' . $bin ?? '', ['headers' => ['Accept-Version' => 3]]);
        return BinList::fromJson($response->getBody());
    }
}
