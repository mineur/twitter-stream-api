# Twitter Streaming API
Yes. Another Twitter streaming Api PHP library.

```php
use Alexhoma\TwitterStreamApi\HttpClient;
use Alexhoma\TwitterStreamApi\PublicStream;

$httpClient = new HttpClient(
    'consumer_key',
    'consumer_secret',
    'access_token',
    'access_token_secret'
);
(new PublicStream($httpClient))->open('hello');
```