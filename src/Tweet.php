<?php

namespace Mineur\TwitterStreamApi;

class Tweet
{
    /** @var string */
    private $text;

    /** @var string */
    private $language;

    /** @var string */
    private $createdAt;

    /** @var string */
    private $timestampMs;

    /** @var string */
    private $geo;

    /** @var string */
    private $coordinates;

    /** @var string */
    private $places;

    /** @var int */
    private $retweetCount;

    /** @var int */
    private $favoriteCount;

    /** @var array */
    private $user;

    /**
     * Tweet constructor.
     *
     * @param string $text
     * @param string $language
     * @param string $createdAt
     * @param string $timestampMs
     * @param array|null $geo
     * @param array|null $coordinates
     * @param array|null $places
     * @param int $retweetCount
     * @param int $favoriteCount
     * @param array $user
     */
    public function __construct(
        string $text,
        string $language,
        string $createdAt,
        string $timestampMs,
        ? array $geo,
        ? array $coordinates,
        ? array $places,
        int $retweetCount,
        int $favoriteCount,
        array $user
    )
    {
        $this->text = $text;
        $this->language = $language;
        $this->createdAt = $createdAt;
        $this->timestampMs = $timestampMs;
        $this->geo = $geo;
        $this->coordinates = $coordinates;
        $this->places = $places;
        $this->retweetCount = $retweetCount;
        $this->favoriteCount = $favoriteCount;
        $this->user = $user;
    }

    /**
     * Create Tweet from Array
     *
     * @param array $tweet
     * @return Tweet
     */
    public static function fromArray(array $tweet): self
    {
        return new self(
            $tweet['text'],
            $tweet['language'],
            $tweet['created_at'],
            $tweet['timestamp_ms'],
            $tweet['geo'],
            $tweet['coordinates'],
            $tweet['place'],
            $tweet['retweet_count'],
            $tweet['favorite_count'],
            $tweet['user']
        );
    }
}