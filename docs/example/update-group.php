<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Fields
$fields = [
    'name' => 'New group name!',
];

// Get resource
$client->updateResource('group', 123, $fields);

// Display result
$status = $client->getLastResponse()->getMeta()->getStatus();
echo 'Group ' . ('success' != $status ? 'not ' : '') . 'updated';
