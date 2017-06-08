<?php

namespace Mineur\TwitterStreamApi\Model;


class RetweetedStatus
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
    
    /**
     * Tweet constructor.
     *
     * @param int        $id
     * @param string     $text
     * @param string     $lang
     * @param string     $createdAt
     * @param array|null $geo
     * @param array|null $coordinates
     * @param array|null $places
     * @param int        $retweetCount
     * @param int        $favoriteCount
     * @param array      $entities
     * @param array|null $extendedEntities
     * @param User       $user
     */
    private function __construct(
        int $id,
        string $text,
        string $lang,
        string $createdAt,
        ? array $geo,
        ? array $coordinates,
        ? array $places,
        int $retweetCount,
        int $favoriteCount,
        array $entities,
        ? array $extendedEntities,
        User $user
    )
    {
        $this->id               = $id;
        $this->text             = $text;
        $this->lang             = $lang;
        $this->createdAt        = $createdAt;
        $this->geo              = $geo;
        $this->coordinates      = $coordinates;
        $this->places           = $places;
        $this->retweetCount     = $retweetCount;
        $this->favoriteCount    = $favoriteCount;
        $this->entities         = $entities;
        $this->extendedEntities = $extendedEntities;
        $this->user             = $user;
    }
    
    /**
     * Create Tweet from Array
     *
     * @param array $retweet
     * @return RetweetedStatus
     */
    public static function fromArray(array $retweet): self
    {
        $extendedEntities = isset($retweet['extended_entities'])
            ? $retweet['extended_entities']
            : null
        ;
        $user = isset($retweet['user'])
            ? User::fromArray($retweet['user'])
            : null
        ;
        
        return new self(
            $retweet['id'],
            $retweet['text'],
            $retweet['lang'],
            $retweet['created_at'],
            $retweet['geo'],
            $retweet['coordinates'],
            $retweet['place'],
            $retweet['retweet_count'],
            $retweet['favorite_count'],
            $retweet['entities'],
            $extendedEntities,
            $user
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
            'geo'               => $this->geo,
            'coordinates'       => $this->coordinates,
            'places'            => $this->places,
            'retweet_count'     => $this->retweetCount,
            'favorite_count'    => $this->favoriteCount,
            'entities'          => $this->entities,
            'extended_entities' => $this->extendedEntities,
            'user'              => $this->user
        ];
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
}