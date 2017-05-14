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
        return new self(
            $httpClient,
            new GuzzleStream()
        );
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
//        $tweet = json_decode($tweet, true);

        $this->returnTweetObject($tweet);
    }

    /**
     * Return hydrated Tweet object
     *
     * @param array $tweet
     * @return Tweet
     */
    private function returnTweetObject(array $tweet): Tweet
    {
        dump(Tweet::fromArray($tweet));

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
