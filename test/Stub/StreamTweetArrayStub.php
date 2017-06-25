<?php

/*
 * Mineur/twitter-stream-api package
 *
 * Feel free to contribute!
 *
 * @license MIT
 * @author alexhoma <alexcm.14@gmail.com>
 */

namespace Mineur\TwitterStreamApiTest\Stub;

use Faker\Factory;

/**
 * Class StreamTweetStub
 * This Stub returns an array representing a tweet
 * from the twitter streaming feed
 *
 * @package Mineur\TwitterStreamApiTest\Stub
 */
class StreamTweetArrayStub
{
    public static function create(): array
    {
        $factory = Factory::create();

        return [
            'id'                => $factory->numberBetween(0, 100000),
            'text'              => $factory->text(),
            'lang'              => $factory->languageCode(),
            'created_at'        => $factory->time('D M d H:m:s Z Y', 'now'),
            'timestamp_ms'      => $factory->unixTime(),
            'geo'               => $factory->shuffleArray(),
            'coordinates'       => $factory->shuffleArray(),
            'place'             => $factory->shuffleArray(),
            'retweet_count'     => $factory->numberBetween(0, 100),
            'favorite_count'    => $factory->numberBetween(0, 100),
            'entities'          => $factory->shuffleArray(),
            'extended_entities' => $factory->shuffleArray(),
            'user'              => self::createUserArray($factory),
            'retweetedStatus'   => self::createRetweetedStatusArray($factory)
        ];
    }
    
    private static function createUserArray($factory)
    {
        return [
            'id'                            => $factory->numberBetween(0, 100000),
            'name'                          => $factory->name(),
            'screen_name'                   => $factory->name(),
            'location'                      => $factory->text(),
            'url'                           => $factory->url(),
            'description'                   => $factory->text(),
            'protected'                     => $factory->boolean(),
            'verified'                      => $factory->boolean(),
            'followers_count'               => $factory->numberBetween(0, 100),
            'friends_count'                 => $factory->numberBetween(0, 100),
            'listed_count'                  => $factory->numberBetween(0, 100),
            'favourites_count'              => $factory->numberBetween(0, 100),
            'statuses_count'                => $factory->numberBetween(0, 100),
            'created_at'                    => $factory->time('D M d H:m:s Z Y', 'now'),
            'utc_offset'                    => $factory->text(),
            'time_zone'                     => $factory->timezone(),
            'geo_enabled'                   => $factory->boolean(),
            'lang'                          => $factory->languageCode(),
            'profile_background_image_url'  => $factory->url(),
            'profile_image_url'             => $factory->url(),
        ];
    }
    
    private static function createRetweetedStatusArray($factory)
    {
        return [
            'id'                => $factory->uuid(),
            'text'              => $factory->text(),
            'lang'              => $factory->languageCode(),
            'created_at'        => $factory->time('D M d H:m:s Z Y', 'now'),
            'geo'               => $factory->shuffleArray(),
            'coordinates'       => $factory->shuffleArray(),
            'place'             => $factory->shuffleArray(),
            'retweet_count'     => $factory->numberBetween(0, 100),
            'favorite_count'    => $factory->numberBetween(0, 100),
            'entities'          => $factory->shuffleArray(),
            'extended_entities' => $factory->shuffleArray(),
        ];
    }
}