<?php

namespace Mineur\TwitterStreamApi;

class Tweet
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $timestampMs;

    /**
     * @var string
     */
    private $geo;

    /**
     * @var string
     */
    private $coordinates;

    /**
     * @var string
     */
    private $places;

    /**
     * @var int
     */
    private $retweetCount;

    /**
     * @var int
     */
    private $favoriteCount;

    /**
     * Tweet constructor.
     *
     * @param string $text
     * @param string $createdAt
     * @param string $timestampMs
     * @param array|null $geo
     * @param array|null $coordinates
     * @param array|null $places
     * @param int $retweetCount
     * @param int $favoriteCount
     */
    public function __construct(
        string $text,
        string $createdAt,
        string $timestampMs,
        ? array $geo,
        ? array $coordinates,
        ? array $places,
        int $retweetCount,
        int $favoriteCount
    )
    {
        $this->text = $text;
        $this->createdAt = $createdAt;
        $this->timestampMs = $timestampMs;
        $this->geo = $geo;
        $this->coordinates = $coordinates;
        $this->places = $places;
        $this->retweetCount = $retweetCount;
        $this->favoriteCount = $favoriteCount;
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
            $tweet['created_at'],
            $tweet['timestamp_ms'],
            $tweet['geo'],
            $tweet['coordinates'],
            $tweet['place'],
            $tweet['retweet_count'],
            $tweet['favorite_count']
        );
    }
}