# Twitter Streaming API
[![Travis](https://travis-ci.org/mineur/twitter-stream-api.svg?branch=master)]()
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg)]()
[![Latest Unstable Version](https://poser.pugx.org/mineur/twitter-stream-api/v/unstable)](https://packagist.org/packages/mineur/twitter-stream-api)
[![Total Downloads](https://poser.pugx.org/mineur/twitter-stream-api/downloads)](https://packagist.org/packages/mineur/twitter-stream-api)

Yes. Another Twitter Stream PHP library. For now it just works on public stream, using the filter method.<br>

## Installation
```php
composer require mineur/twitter-stream-api:dev-master
```

## Basic initialization
Instantiate the GuzzleHttpClient adapter with your Twitter api tokens. And start 
consuming Twitter's Stream with some keywords! :)
```php
use Mineur\TwitterStreamApi\Http\GuzzleStreamClient;
use Mineur\TwitterStreamApi\PublicStream;

$streamClient = new GuzzleStreamClient(
    'consumer_key',
    'consumer_secret',
    'access_token',
    'access_token_secret'
);
PublicStream::open($streamClient)
    ->listenFor(['your','keywords','list'])
    ->consume();
```

You can also use a callback instead, if you want to modify the original output:
```php
use Mineur\TwitterStreamApi\Tweet;

PublicStream::open($streamClient)
    ->listenFor(['your','keywords','list'])
    ->do(function(Tweet $tweet) {
        echo "$tweet->getUser() tweeted: $tweet->getText()"
    });
```

### Filtering tweets by user ID
In this example you'll only get the tweets of a user corresponding to its ID.
```php
PublicStream::open($streamClient)
    ->tweetedBy(['1234567'])
    ->consume();
```

### Filtering keywords by language
In this example you'll only get the tweets on your keywords list write in spanish 
language. 
```php
PublicStream::open($streamClient)
    ->listenFor(['keywords','list'])
    ->setLanguage('es')
    ->consume();
```

## The Tweet object
Once you receive the output from the PublicStream, let's say when you are usng the `do` 
callback function, the output will always be an hydrated Tweet value object.
\
You can access it with the following methods:
* Using getters:
```php
// Get specific data from the object
$tweet->getText();
```
* As an array:
```php
// Transform object to an array, then access to the data
$aTweet = $tweet->toArray();
$aTweet['text'];
```
* Serialized:
```php
// A complete serialized object to enqueue it, for example
$tweet->serialized();
```

## Remember
Working with the Twitter Stream you cannot open two stream lines with the same 
account. You should create another app account and raise a new instance of this 
library.

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