<?php

namespace Alexhoma\TwitterStreamApi;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;


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
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Open stream
     *
     * @param $keyword
     */
    public function open(string $keyword)
    {
        $body = $this->listenFor($keyword);

        while (!$body->eof()) {
            $tweet = json_decode($this->readStreamLine($body), true);
            echo $tweet['text'] . PHP_EOL;
        }
    }

    /**
     * Listen for unique keyword
     *
     * @todo add keywords array
     * @param string $keyword
     * @return \Psr\Http\Message\StreamInterface
     */
    private function listenFor(string $keyword)
    {
        $client = $this->httpClient;

        return $client()->post('statuses/filter.json', [
            'form_params' => [
                'track' => $keyword,
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