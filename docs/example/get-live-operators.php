<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Get live resource
$resources = $client->getLiveResources('operator');

// Display resources
if ($resources) {

} else {
    echo $client->getLastResponse()->getMeta()->getMessage();
}
