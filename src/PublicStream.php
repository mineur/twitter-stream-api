<?php

namespace Alexhoma\TwitterStreamApi;

use GuzzleHttp\Psr7\Stream;
use Alexhoma\TwitterStreamApi\Http\GuzzleHttpClient;
use Alexhoma\TwitterStreamApi\Http\HttpClient;


/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Alexhoma\TwitterStreamApi
 */
final class PublicStream
{
    /** @var GuzzleHttpClient */
    private $httpClient;

    /** @var $keywords */
    private $keywords;

    /** @var $language */
    private $language;

    private function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public static function open(HttpClient $httpClient)
    {
        return new self($httpClient);
    }

    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    public function listenFor(array $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function consume()
    {
        $body = $this->requestData();

        while (!$body->eof()) {
            $tweet = json_decode(
                $this->readStreamLine($body),
                true
            );

            echo $tweet['text'];
        }
    }

    private function requestData()
    {
        $client = $this->httpClient;
        $keywords = implode(',', $this->keywords);

        return $client()->post('statuses/filter.json', [
            'form_params' => [
                'track' => $keywords,
                'language' => ($this->language)?
                    $this->language : '',
            ],
        ])->getBody();
    }

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