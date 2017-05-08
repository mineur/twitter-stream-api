# Twitter Streaming API
Yes. Another Twitter streaming Api PHP library. For now it just works on public stream, using the filter method.<br>

### Installation
```php
composer require alexhoma/twitter-stream-api
```

### Basic initialization
Instantiate the GuzzleHttpClient with your Twitter api tokens. And start consuming Twitter's Stream with some keywords! :)
```php
use Alexhoma\TwitterStreamApi\HttpClient;
use Alexhoma\TwitterStreamApi\PublicStream;

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
// Instantiate again your http client

PublicStream::open($httpClient)
    ->listenFor(['keywords','list'])
    ->setLanguage('es')
    ->consume();
```

### Remember
You cannot open two stream lines with the same account in Twitter Stream Api.