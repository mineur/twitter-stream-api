<?php

namespace Mineur\TwitterStreamApi;

use Mineur\TwitterStreamApi\Http\GuzzleHttpClient;
use Mineur\TwitterStreamApi\Http\HttpClient;
use Mineur\TwitterStreamApi\Stream\GuzzleStream;
use Mineur\TwitterStreamApi\Stream\Stream;


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
     * Start consuming the Stream API
     */
    public function consume()
    {
        $keywords = implode(',', $this->keywords);
        $language = $this->language ?? '';

        $tweet = $this->httpClient->post('statuses/filter.json', [
            'form_params' => [
                'track'    => $keywords,
                'language' => $language
            ],
        ]);

        dump(Tweet::fromArray($tweet));
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
}
