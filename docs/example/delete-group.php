<?php

namespace Example;

require 'init.php';

use Iadvize\ApiRestClient\Client;

// Create client
$client = new Client();
$client->setAuthenticationKey(API_KEY);

// Get resource
$success = $client->deleteResource('group', 123);

// Display result
echo 'Delete ' . ($success ? 'successful' : 'aborted');
