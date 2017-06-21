# Twitter Streaming API
[![License](https://poser.pugx.org/mineur/twitter-stream-api/license)](https://packagist.org/packages/mineur/twitter-stream-api)
[![Build Status](https://travis-ci.org/mineur/twitter-stream-api.svg?branch=master)](https://travis-ci.org/mineur/twitter-stream-api)
[![Code Climate](https://codeclimate.com/github/mineur/twitter-stream-api/badges/gpa.svg)](https://codeclimate.com/github/mineur/twitter-stream-api)
[![Latest Unstable Version](https://poser.pugx.org/mineur/twitter-stream-api/v/unstable)](https://packagist.org/packages/mineur/twitter-stream-api)
[![Total Downloads](https://poser.pugx.org/mineur/twitter-stream-api/downloads)](https://packagist.org/packages/mineur/twitter-stream-api)

Another Twitter Stream PHP library. For now it just works on public stream, 
using the filter method. 

## Index
- [Installation](#installation)
- [Basic init](#basic-initialization)
    - [Callback method](#callback-method)
    - [Filter by user](#filtering-tweets-by-user-id)
    - [Filter by language](#filtering-keywords-by-language)
- [The Tweet object](#the-tweet-object)
- [Integrations (Symfony)](#integrations)
- [Tests](#run-tests)
- [To-do](#todos)

## Installation
```shell
composer require mineur/twitter-stream-api:dev-master
```

## Basic initialization
Instantiate the GuzzleHttpClient adapter with your Twitter api tokens. 
And start consuming Twitter's Stream with some keywords! :) \
If you don't have your Twitter API credentials, check this: 
<a href="https://dev.twitter.com/oauth/overview/application-owner-access-tokens" 
   target="_blank">
    How to get your twitter access tokens
</a>
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
    ->listenFor([
        'your',
        'keywords',
        'list'
    ])
    ->consume();
```
> Working with the Twitter Stream you cannot open two stream lines with the same 
> account. You should create another app account and raise a new instance of this 
> library.

### Callback method
You can also use a callback instead, if you want to modify the original output:
```php
use Mineur\TwitterStreamApi\Tweet;

PublicStream::open($streamClient)
    ->listenFor([
        'your',
        'keywords',
        'list'
    ])
    ->do(function(Tweet $tweet) {
        echo "$tweet->getUser() tweeted: $tweet->getText()";
    });
```

### Filtering tweets by user ID
In this example you'll only get the tweets of a user corresponding to its ID.
```php
$myTwitterId = '1234567';
PublicStream::open($streamClient)
    ->tweetedBy([
        $myTwitterId
    ])
    ->consume();
```

### Filtering keywords by language
In this example you'll only get the tweets on your keywords list write in spanish 
language. 
```php
PublicStream::open($streamClient)
    ->listenFor([
        'keywords',
        'list'
    ])
    ->setLanguage('es')
    ->consume();
```

## The Tweet object
Once you receive the output from the PublicStream, let's say when you are using the `do` 
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

## Integrations
For Symfony integrations you can refer to this bundle: 
[Mineur Twitter Stream Api Bundle](https://github.com/mineur/twitter-stream-api-bundle)

## Run tests
```php
composer install
./bin/phpunit
```
To check the coverage just add:
```php
./bin/phpunit --coverage-text
```

## Todo's
* STREAMING_ENDPOINT should be changed by client, using simple string injection
* Add links of the filters in documentation
* Test the first version of this library using Unit testing
* Handle when a user removes a tweet on the fly.
* Add `filter_level` feature
* Add track `location` feature