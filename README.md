# Twitter Streaming API
Yes. Another Twitter Stream PHP library. For now it just works on public stream, using the filter method.<br>

## Installation
```php
composer require mineur/twitter-stream-api
```

## Basic initialization
Instantiate the GuzzleHttpClient with your Twitter api tokens. And start consuming Twitter's Stream with some keywords! :)
```php
use Mineur\TwitterStreamApi\Http\StreamClient;
use Mineur\TwitterStreamApi\PublicStream;

$streamClient = new StreamClient(
    'consumer_key',
    'consumer_secret',
    'access_token',
    'access_token_secret'
);
PublicStream::open($streamClient)
    ->listenFor(['your','keywords','list'])
    ->consume();
```

### Filtering tweets by user ID
In this example you'll only get the tweets of a user corresponding to its ID.
```php
$streamClient = new StreamClient(/* Your keys */);

PublicStream::open($streamClient)
    ->tweetedBy(['1234567'])
    ->consume();
```

### Filtering keywords by language
In this example you'll only get the tweets on your keywords list write in spanish language. 
```php
$streamClient = new StreamClient(/* Your keys */);

PublicStream::open($streamClient)
    ->listenFor(['keywords','list'])
    ->setLanguage('es')
    ->consume();
```

## Remember
Working with the Twitter Stream you cannot open two stream lines with the same account. You should create another app account and raise a new instance of this library.

## Run tests
```php
composer install
./bin/vendor/phpunit
```
To check the coverage just add:
```php
./bin/vendor/phpunit --coverage-text
```

## Todo's
* STREAMING_ENDPOINT should be changed by client, using simple string injection
* Add links of the filters in documentation
* Test the first version of this library using Unit testing
* Handle when a user removes a tweet on the fly.