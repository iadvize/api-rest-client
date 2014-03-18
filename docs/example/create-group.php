<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Fields
$fields = [
    'name' => 'New group!',
];

// Get resource
$client->createResource('group', $fields);

// Display result
$status = $client->getLastResponse()->getMeta()->getStatus();
echo 'Group ' . ('success' != $status ? 'not ' : '') . 'created';
