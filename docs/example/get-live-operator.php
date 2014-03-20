<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Get live resource
$resource = $client->getLiveResource('operator', 123);

// Display resource
if ($resource) {

} else {
    echo $client->getLastResponse()->getMeta()->getMessage();
}
