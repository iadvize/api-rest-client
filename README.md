iAdvize Api Client [![CircleCI](https://circleci.com/gh/iadvize/api-rest-client.svg?style=svg)](https://circleci.com/gh/iadvize/api-rest-client) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iadvize/api-rest-client/badges/quality-score.png?s=0e0a32e3db466d1307db4ccbb57d0eee0edddf35)](https://scrutinizer-ci.com/g/iadvize/api-rest-client/) [![Code Coverage](https://scrutinizer-ci.com/g/iadvize/api-rest-client/badges/coverage.png?s=4bcdf916731549027f32e147a72d88c501cd80e3)](https://scrutinizer-ci.com/g/iadvize/api-rest-client/)
==================

Library to access iAdvize api

## Examples

### List websites

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

## Install

```php
composer require iadvize/apirestclient
```

## Documentation

You can access the documentation here : [documentation](https://developers.iadvize.com/documentation#resources)

### Launch tests

```php
cp ./phpunix.xml.dist ./phpunix.xml
./vendor/bin/phpunit -c phpunit.xml
```

## Contribute

Look at contribution guidelines here : [CONTRIBUTING.md](CONTRIBUTING.md)
