<?php

namespace Mineur\TwitterStreamApi;

use Mineur\TwitterStreamApi\Http\GuzzleStreamClient;
use Mineur\TwitterStreamApi\Http\StreamClient;


/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Mineur\TwitterStreamApi
 */
final class PublicStream
{
    /** @var GuzzleStreamClient */
    private $streamClient;

    /** @var $language */
    private $language;

    /** @var $keywords */
    private $keywords;

    /** @var $users */
    private $users;

    /**
     * PublicStream constructor.
     *
     * @param StreamClient $streamClient
     */
    private function __construct(StreamClient $streamClient)
    {
        $this->streamClient = $streamClient;
    }

    /**
     * Open the stream connection
     *
     * @param StreamClient $streamClient
     * @return PublicStream
     */
    public static function open(StreamClient $streamClient): self
    {
        return new self($streamClient);
    }

    /**
     * Start consuming the Stream API
     */
    public function consume()
    {
        $language = $this->language ?? '';
        $keywords = $this->keywords ?? [];
        $users    = $this->users ?? [];

        $this->streamClient->post('statuses/filter.json', [
            'form_params' => [
                'language' => $language,
                'track'    =>  implode(',', $keywords),
                'follow'    => implode(',', $users),
            ],
        ]);

        while ($tweet = $this->streamClient->read()) {
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


    public function tweetedBy(array $users): self
    {
        $this->users = $users;

        return $this;
    }
}
