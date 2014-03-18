iAdvize Api Client
==================

[![Build Status](https://travis-ci.org/iadvize/api-rest-client.png?branch=1.0.0)](https://travis-ci.org/iadvize/api-rest-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iadvize/api-rest-client/badges/quality-score.png?s=0e0a32e3db466d1307db4ccbb57d0eee0edddf35)](https://scrutinizer-ci.com/g/iadvize/api-rest-client/)
[![Code Coverage](https://scrutinizer-ci.com/g/iadvize/api-rest-client/badges/coverage.png?s=4bcdf916731549027f32e147a72d88c501cd80e3)](https://scrutinizer-ci.com/g/iadvize/api-rest-client/)

This project gives you access to iAdvize API easily.

## Basic usage

### Example: List websites

```php
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

```

## Install dependencies

    composer install --dev

## Launch tests

    cp ./phpunix.xml.dist ./phpunix.xml
    ./vendor/bin/phpunit -c phpunit.xml