# Twitter Streaming API
Yes. Another Twitter streaming Api PHP library. For now it just works on public stream, using the filter method.<br>

### Basic initialization
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
    ->listenFor(['keywords','list']);
```