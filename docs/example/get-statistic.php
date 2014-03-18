<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Get resource
$resources = $client->getResources('statistic', true, [
    'website_id' => 123,
    'channel'    => 'chat',
    'resource'   => 'operator',
    'indicators' => [
        'contact_duration',
        'contact_waiting_duration',
        'contact_number',
        'contact_simultaneous_number',
        'contact_waiting_number',
    ],
    'from'       => '2014-01-01',
    'to'         => '2014-01-31',
]);

// Display resource
if ($resources) {
    foreach ($resources as $resource) {
        printf(
            '[%s] — %d / %d / %d / %d' . PHP_EOL,
            $resource['id'],
            $resource['contact_duration'],
            $resource['contact_waiting_duration'],
            $resource['contact_number'],
            $resource['contact_simultaneous_number'],
            $resource['contact_waiting_number']
        );
    }
} else {
    echo $client->getLastResponse()->getMeta()->getMessage();
}
