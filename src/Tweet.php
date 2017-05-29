<?php

namespace Mineur\TwitterStreamApi;

class Tweet
{
    /** @var string */
    private $text;
    
    /** @var string */
    private $lang;
    
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
     * @param string     $text
     * @param string     $lang
     * @param string     $createdAt
     * @param string     $timestampMs
     * @param array|null $geo
     * @param array|null $coordinates
     * @param array|null $places
     * @param int        $retweetCount
     * @param int        $favoriteCount
     * @param array      $user
     */
    public function __construct(
        string $text,
        string $lang,
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
        $this->lang = $lang;
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
            $tweet['lang'],
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
    
    /**
     * Return Tweet object to Array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'text'           => $this->text,
            'lang'           => $this->lang,
            'created_at'     => $this->createdAt,
            'timestamp_ms'   => $this->timestampMs,
            'geo'            => $this->geo,
            'coordinates'    => $this->coordinates,
            'places'         => $this->places,
            'retweet_count'  => $this->retweetCount,
            'favorite_count' => $this->favoriteCount,
            'user'           => $this->user
        ];
    }
    
    /**
     * Return serielized Tweet object
     *
     * @return string
     */
    public function serialized(): string
    {
        return serialize(
            new self(
                $this->text,
                $this->lang,
                $this->createdAt,
                $this->timestampMs,
                $this->geo,
                $this->coordinates,
                $this->places,
                $this->retweetCount,
                $this->favoriteCount,
                $this->user
            )
        );
    }
    
    /** @return string */
    public function getText(): string
    {
        return $this->text;
    }
    
    /** @return string */
    public function getLang(): string
    {
        return $this->lang;
    }
    
    /** @return string */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    
    /** @return string */
    public function getTimestampMs(): string
    {
        return $this->timestampMs;
    }
    
    /** @return string */
    public function getGeo(): string
    {
        return $this->geo;
    }
    
    /** @return string */
    public function getCoordinates(): string
    {
        return $this->coordinates;
    }
    
    /** @return string */
    public function getPlaces(): string
    {
        return $this->places;
    }
    
    /** @return int */
    public function getRetweetCount(): int
    {
        return $this->retweetCount;
    }
    
    /** @return int */
    public function getFavoriteCount(): int
    {
        return $this->favoriteCount;
    }
    
    /** @return array */
    public function getUser(): array
    {
        return $this->user;
    }
}