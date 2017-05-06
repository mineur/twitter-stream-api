<?php

namespace Alexhoma\TwitterStreamApi;

use Alexhoma\TwitterStreamApi\HttpClient;

/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Alexhoma\TwitterStreamApi
 */
final class PublicStream
{
    /** @var string */
    const STREAMING_ENDPOINT = 'https://stream.twitter.com/1.1/';

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

    public function open($keyword)
    {
        $body = $this->listenFor($keyword);

        while (!$body->eof()) {
            $tweet = json_decode($this->readStreamLine($body), true);
            echo $tweet['text'] . PHP_EOL;
        }
    }

    private function listenFor(string $keyword)
    {
        $client = $this->httpClient;

//        return $client()->post('statuses/filter.json', [
//            'form_params' => [
//                'track' => $keyword,
//            ],
//        ]);

        return $client()->get('/statuses/sample.json');

    }

    private function readStreamLine($stream, $maxLength = null, $eol = PHP_EOL)
    {
        $buffer    = '';
        $size      = 0;
        $negEolLen = -strlen($eol);

        while (!$stream->eof()) {
            if (false === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;

            if (++$size == $maxLength || substr($buffer, $negEolLen) === $eol) {
                break;
            }
        }

        return $buffer;
    }
}