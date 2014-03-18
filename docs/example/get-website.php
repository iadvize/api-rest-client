<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Get resource
$website = $client->getResource('website', 123);

// Display resource
if ($website) {
    printf(
        '[%s] — %s - http://%s' . PHP_EOL,
        $website['id'],
        $website['name'],
        $website['url']
    );
} else {
    echo $client->getLastResponse()->getMeta()->getMessage();
}
