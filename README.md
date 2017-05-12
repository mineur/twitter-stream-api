# Twitter Streaming API
Yes. Another Twitter Stream PHP library. For now it just works on public stream, using the filter method.<br>

### Installation
```php
composer require mineur/twitter-stream-api
```

### Basic initialization
Instantiate the GuzzleHttpClient with your Twitter api tokens. And start consuming Twitter's Stream with some keywords! :)
```php
use Mineur\TwitterStreamApi\HttpClient;
use Mineur\TwitterStreamApi\PublicStream;

$httpClient = new HttpClient(
    'consumer_key',
    'consumer_secret',
    'access_token',
    'access_token_secret'
);
PublicStream::open($httpClient)
    ->listenFor(['your','keywords','list'])
    ->consume();
```

### Filtering keywords by language
In this example you'll only get the tweets on your keywords list write in spanish language. 
```php
// Instantiate the guzzle http client with your twitter app tokens

PublicStream::open($httpClient)
    ->listenFor(['keywords','list'])
    ->setLanguage('es')
    ->consume();
```

### Remember
You cannot open two stream lines with the same account in Twitter Stream Api.

### TODO
* STREAMING_ENDPOINT should be changed by client, using simple string injection