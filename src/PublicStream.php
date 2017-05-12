<?php

namespace Mineur\TwitterStreamApi;

use GuzzleHttp\Psr7\Stream;
use Mineur\TwitterStreamApi\Http\GuzzleHttpClient;
use Mineur\TwitterStreamApi\Http\HttpClient;


/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Mineur\TwitterStreamApi
 */
final class PublicStream
{
    /** @var GuzzleHttpClient */
    private $httpClient;

    /** @var $keywords */
    private $keywords;

    /** @var $language */
    private $language;

    /**
     * PublicStream constructor.
     *
     * @param HttpClient $httpClient
     */
    private function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Open the stream connection
     *
     * @param HttpClient $httpClient
     * @return PublicStream
     */
    public static function open(HttpClient $httpClient): self
    {
        return new self($httpClient);
    }

    /**
     * Set Tweet search language
     *
     * @param string $language
     * @return PublicStream
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Set keywords to track
     *
     * @param array $keywords
     * @return PublicStream
     */
    public function listenFor(array $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Start consuming the Stream API
     */
    public function consume()
    {
        $body = $this->requestData();

        while (!$body->eof()) {
            $tweet = json_decode(
                $this->readStreamLine($body),
                true
            );

            $this->returnTweetObject($tweet);
        }
    }

    /**
     * Return an hydrated tweet object
     *
     * @param array $tweet
     * @return Tweet
     */
    private function returnTweetObject(array $tweet): Tweet
    {
        return Tweet::fromArray($tweet);
    }

    private function requestData()
    {
        $keywords = implode(',', $this->keywords);

        return $this->httpClient->post('statuses/filter.json', [
            'form_params' => [
                'track'    => $keywords,
                'language' => $this->language ?? ''
            ],
        ]);
    }

    private function readStreamLine(
        Stream $stream,
        int $maxLength = null
    ) : string
    {
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