<?php

namespace Mineur\TwitterStreamApi\Model;

class Tweet
{
    /** @var int */
    private $id;
    
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
    private $entities;
    
    /** @var array */
    private $extendedEntities;
    
    /** @var User */
    private $user;
    
    /** @var RetweetedStatus */
    private $retweetedStatus;
    
    /**
     * Tweet constructor.
     *
     * @param int        $id
     * @param string     $text
     * @param string     $lang
     * @param string     $createdAt
     * @param string     $timestampMs
     * @param array|null $geo
     * @param array|null $coordinates
     * @param array|null $places
     * @param int        $retweetCount
     * @param int        $favoriteCount
     * @param array      $entities
     * @param array|null $extendedEntities
     * @param User       $user
     * @param RetweetedStatus|null $retweetedStatus
     */
    private function __construct(
        int $id,
        string $text,
        string $lang,
        string $createdAt,
        string $timestampMs,
        ? array $geo,
        ? array $coordinates,
        ? array $places,
        int $retweetCount,
        int $favoriteCount,
        array $entities,
        ? array $extendedEntities,
        User $user,
        ? RetweetedStatus $retweetedStatus
    )
    {
        $this->id               = $id;
        $this->text             = $text;
        $this->lang             = $lang;
        $this->createdAt        = $createdAt;
        $this->timestampMs      = $timestampMs;
        $this->geo              = $geo;
        $this->coordinates      = $coordinates;
        $this->places           = $places;
        $this->retweetCount     = $retweetCount;
        $this->favoriteCount    = $favoriteCount;
        $this->entities         = $entities;
        $this->extendedEntities = $extendedEntities;
        $this->user             = $user;
        $this->retweetedStatus  = $retweetedStatus;
    }
    
    /**
     * Create Tweet from Array
     *
     * @param array $tweet
     * @return Tweet
     */
    public static function fromArray(array $tweet): self
    {
        $extendedEntities = isset($tweet['extended_entities'])
            ? $tweet['extended_entities']
            : null
        ;
        $user = isset($tweet['user'])
            ? User::fromArray($tweet['user'])
            : null
        ;
        $retweetedStatus = isset($tweet['retweeted_status'])
            ? RetweetedStatus::fromArray($tweet['retweeted_status'])
            : null
        ;
        
        return new self(
            $tweet['id'],
            $tweet['text'],
            $tweet['lang'],
            $tweet['created_at'],
            $tweet['timestamp_ms'],
            $tweet['geo'],
            $tweet['coordinates'],
            $tweet['place'],
            $tweet['retweet_count'],
            $tweet['favorite_count'],
            $tweet['entities'],
            $extendedEntities,
            $user,
            $retweetedStatus
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
            'id'                => $this->id,
            'text'              => $this->text,
            'lang'              => $this->lang,
            'created_at'        => $this->createdAt,
            'timestamp_ms'      => $this->timestampMs,
            'geo'               => $this->geo,
            'coordinates'       => $this->coordinates,
            'places'            => $this->places,
            'retweet_count'     => $this->retweetCount,
            'favorite_count'    => $this->favoriteCount,
            'entities'          => $this->entities,
            'extended_entities' => $this->extendedEntities,
            'user'              => $this->user,
            'retweeted_status'  => $this->retweetedStatus
        ];
    }
    
    /**
     * Return serialized Tweet object
     *
     * @return string
     */
    public function serialized(): string
    {
        return serialize(
            new self(
                $this->id,
                $this->text,
                $this->lang,
                $this->createdAt,
                $this->timestampMs,
                $this->geo,
                $this->coordinates,
                $this->places,
                $this->retweetCount,
                $this->favoriteCount,
                $this->entities,
                $this->extendedEntities,
                $this->user,
                $this->retweetedStatus
            )
        );
    }
    
    /** @return int */
    public function getId(): int
    {
        return $this->text;
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
    
    /** @return array */
    public function getGeo(): ? array
    {
        return $this->geo;
    }
    
    /** @return array */
    public function getCoordinates(): ? array
    {
        return $this->coordinates;
    }
    
    /** @return array */
    public function getPlaces(): ? array
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
    public function getEntities(): array
    {
        return $this->entities;
    }
    
    /** @return array */
    public function getExtendedEntities(): ? array
    {
        return $this->extendedEntities;
    }
    
    /** @return User */
    public function getUser(): User
    {
        return $this->user;
    }
    
    /** @return RetweetedStatus|null */
    public function getRetweetedStatus(): ? RetweetedStatus
    {
        return $this->retweetedStatus;
    }
}