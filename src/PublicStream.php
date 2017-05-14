<?php

namespace Mineur\TwitterStreamApi;

use Mineur\TwitterStreamApi\Http\GuzzleStreamHttpClient;
use Mineur\TwitterStreamApi\Http\StreamHttpClient;


/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Mineur\TwitterStreamApi
 */
final class PublicStream
{
    /** @var GuzzleStreamHttpClient */
    private $httpClient;

    /** @var $keywords */
    private $keywords;

    /** @var $language */
    private $language;

    /**
     * PublicStream constructor.
     *
     * @param StreamHttpClient $httpClient
     */
    private function __construct(StreamHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Open the stream connection
     *
     * @param StreamHttpClient $httpClient
     * @return PublicStream
     */
    public static function open(StreamHttpClient $httpClient): self
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

        $this->httpClient->post('statuses/filter.json', [
            'form_params' => [
                'track'    => $keywords,
                'language' => $language
            ],
        ]);

        while ($tweet = $this->httpClient->read()) {
            $this->returnTweetObject($tweet);
        }
    }

    /**
     * Return hydrated Tweet object
     *
     * @param $tweet
     * @return Tweet
     */
    private function returnTweetObject($tweet): Tweet
    {
        return Tweet::fromArray($tweet);
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
