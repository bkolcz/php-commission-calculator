<?php 

use App\Kernel;
use App\Api\BinListProvider;
use App\Api\ExchangeRateIoProvider;
use App\Pattern\Pattern;

require_once dirname(__DIR__).'/vendor/autoload.php';

if(!array_key_exists(1,$argv)) {
    exit("No input file with transactions.\n");
}
// auth-key
$exchangeProviderAccessKey = '';
$exchangeProvider = new ExchangeRateIoProvider($exchangeProviderAccessKey);
$binProvider = new BinListProvider();
$pattern = new Pattern();

$kernel = new Kernel(
    $exchangeProvider,
    $binProvider,
    $pattern,
    $argv[1]
);

$kernel->run();