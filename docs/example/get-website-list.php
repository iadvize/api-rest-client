<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Get resources
$websites = $client->getResources('website', true);

// Display resources
foreach ($websites as $website) {
    printf(
        '[%s] — %s - http://%s' . PHP_EOL,
        $website['id'],
        $website['label'],
        $website['url']
    );
}
