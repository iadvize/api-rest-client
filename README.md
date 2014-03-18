iAdvize Api Client
==================

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