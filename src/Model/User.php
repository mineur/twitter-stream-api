<?php

namespace Mineur\TwitterStreamApi\Model;


class User
{
    /** @var int */
    private $id;
    
    /** @var string */
    private $name;
    
    /** @var string */
    private $screenName;
    
    /** @var string */
    private $location;
    
    /** @var null|string */
    private $url;
    
    /** @var string */
    private $description;
    
    /** @var bool */
    private $protected;
    
    /** @var bool */
    private $verified;
    
    /** @var int */
    private $followersCount;
    
    /** @var int */
    private $friendsCount;
    
    /** @var int */
    private $listedCount;
    
    /** @var int */
    private $favouritesCount;
    
    /** @var int */
    private $statusesCount;
    
    /** @var string */
    private $createdAt;
    
    /** @var null|string */
    private $utcOffset;
    
    /** @var null|string */
    private $timeZone;
    
    /** @var bool */
    private $geoEnabled;
    
    /** @var string */
    private $lang;
    
    /** @var null|string */
    private $profileBackgroundImageUrl;
    
    /** @var null|string */
    private $profileImageUrl;
    
    /**
     * User constructor.
     *
     * @param int         $id
     * @param string      $name
     * @param string      $screenName
     * @param null|string $location
     * @param null|string $url
     * @param string      $description
     * @param bool        $protected
     * @param bool        $verified
     * @param int         $followersCount
     * @param int         $friendsCount
     * @param int         $listedCount
     * @param int         $favouritesCount
     * @param int         $statusesCount
     * @param string      $createdAt
     * @param null|string $utcOffset
     * @param null|string $timeZone
     * @param bool        $geoEnabled
     * @param string      $lang
     * @param null|string $profileBackgroundImageUrl
     * @param null|string $profileImageUrl
     */
    private function __construct(
        int $id,
        string $name,
        ? string $screenName,
        ? string $location,
        ? string $url,
        ? string $description,
        bool $protected,
        bool $verified,
        int $followersCount,
        int $friendsCount,
        int $listedCount,
        int $favouritesCount,
        int $statusesCount,
        string $createdAt,
        ? string $utcOffset,
        ? string $timeZone,
        bool $geoEnabled,
        string $lang,
        ? string $profileBackgroundImageUrl,
        ? string $profileImageUrl
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->screenName = $screenName;
        $this->location = $location;
        $this->url = $url;
        $this->description = $description;
        $this->protected = $protected;
        $this->verified = $verified;
        $this->followersCount = $followersCount;
        $this->friendsCount = $friendsCount;
        $this->listedCount = $listedCount;
        $this->favouritesCount = $favouritesCount;
        $this->statusesCount = $statusesCount;
        $this->createdAt = $createdAt;
        $this->utcOffset = $utcOffset;
        $this->timeZone = $timeZone;
        $this->geoEnabled = $geoEnabled;
        $this->lang = $lang;
        $this->profileBackgroundImageUrl = $profileBackgroundImageUrl;
        $this->profileImageUrl = $profileImageUrl;
    }
    
    /**
     * @param array $user
     * @return User
     */
    public static function fromArray(array $user)
    {
        return new self(
            $user['id'],
            $user['name'],
            $user['screen_name'],
            $user['location'],
            $user['url'],
            $user['description'],
            $user['protected'],
            $user['verified'],
            $user['followers_count'],
            $user['friends_count'],
            $user['listed_count'],
            $user['favourites_count'],
            $user['statuses_count'],
            $user['created_at'],
            $user['utc_offset'],
            $user['time_zone'],
            $user['geo_enabled'],
            $user['lang'],
            $user['profile_background_image_url'],
            $user['profile_image_url']
        );
    }
    
    public function toArray(): array
    {
        return [
            'id'                            => $this->id,
            'name'                          => $this->name,
            'screen_name'                   => $this->screenName,
            'location'                      => $this->location,
            'url'                           => $this->url,
            'description'                   => $this->description,
            'protected'                     => $this->protected,
            'verified'                      => $this->verified,
            'followers_count'               => $this->followersCount,
            'friends_count'                 => $this->friendsCount,
            'listed_count'                  => $this->listedCount,
            'favourites_count'              => $this->favouritesCount,
            'statuses_count'                => $this->statusesCount,
            'created_at'                    => $this->createdAt,
            'utc_offset'                    => $this->utcOffset,
            'time_zone'                     => $this->timeZone,
            'geo_enabled'                   => $this->geoEnabled,
            'lang'                          => $this->lang,
            'profile_background_image_url'  => $this->profileBackgroundImageUrl,
            'profile_image_url'             => $this->profileImageUrl,
        ];
    }
    
    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }
    
    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }
    
    /** @return null|string */
    public function getScreenName(): ? string
    {
        return $this->screenName;
    }
    
    /** @return null|string */
    public function getLocation(): string
    {
        return $this->location;
    }
    
    /** @return null|string */
    public function getUrl(): ? string
    {
        return $this->url;
    }
    
    /** @return null|string */
    public function getDescription(): ? string
    {
        return $this->description;
    }
    
    /** @return bool */
    public function isProtected(): bool
    {
        return $this->protected;
    }
    
    /** @return bool */
    public function isVerified(): bool
    {
        return $this->verified;
    }
    
    /** @return int */
    public function getFollowersCount(): int
    {
        return $this->followersCount;
    }
    
    /** @return int */
    public function getFriendsCount(): int
    {
        return $this->friendsCount;
    }
    
    /** @return int */
    public function getListedCount(): int
    {
        return $this->listedCount;
    }
    
    /** @return int */
    public function getFavouritesCount(): int
    {
        return $this->favouritesCount;
    }
    
    /** @return int */
    public function getStatusesCount(): int
    {
        return $this->statusesCount;
    }
    
    /** @return string */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    
    /** @return null|string */
    public function getUtcOffset(): ? string
    {
        return $this->utcOffset;
    }
    
    /** @return null|string */
    public function getTimeZone(): ? string
    {
        return $this->timeZone;
    }
    
    /** @return bool */
    public function isGeoEnabled(): bool
    {
        return $this->geoEnabled;
    }
    
    /**  @return string */
    public function getLang(): string
    {
        return $this->lang;
    }
    
    /** @return null|string */
    public function getProfileBackgroundImageUrl(): ? string
    {
        return $this->profileBackgroundImageUrl;
    }
    
    /** @return null|string */
    public function getProfileImageUrl(): ? string
    {
        return $this->profileImageUrl;
    }
}