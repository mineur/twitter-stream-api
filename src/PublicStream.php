<?php

namespace Alexhoma\TwitterStreamApi;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\StreamInterface;
use SebastianBergmann\CodeCoverage\Report\PHP;


/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Alexhoma\TwitterStreamApi
 */
final class PublicStream
{
    /** @var HttpClient */
    private $httpClient;

    /**
     * PublicStream constructor.
     * @param \Alexhoma\TwitterStreamApi\HttpClient $httpClient
     */
    private function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Open the stream
     *
     * @param HttpClient $httpClient
     * @return PublicStream
     */
    public static function open(HttpClient $httpClient)
    {
        return new self($httpClient);
    }

    /**
     * Listen keywords on stream
     *
     * @param array $keywords
     * @return mixed
     */
    public function listenFor(array $keywords)
    {
        $body = $this->search($keywords);

        while (!$body->eof()) {
            $tweet = json_decode(
                $this->readStreamLine($body),
                true
            );

            echo $tweet['text'].PHP_EOL;
        }
    }

    /**
     * Search for keywords
     *
     * @param array $keywords
     * @return StreamInterface
     */
    private function search(array $keywords)
    {
        $client = $this->httpClient;
        $keywords = implode(',', $keywords);

        return $client()->post('statuses/filter.json', [
            'form_params' => [
                'track' => $keywords,
                'language' => 'es',
            ],
        ])->getBody();
    }

    /**
     * Read Stream Line
     *
     * @param Stream $stream
     * @param int|null $maxLength
     * @return string
     */
    private function readStreamLine(
        Stream $stream,
        int $maxLength = null
    ) {
        $buffer    = '';
        $size      = 0;
        $negEolLen = -strlen(PHP_EOL);

        while (!$stream->eof()) {
            if (false === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;

            if (++$size == $maxLength || substr($buffer, $negEolLen) === PHP_EOL) {
                break;
            }
        }

        return $buffer;
    }
}