<?php

namespace Mineur\TwitterStreamApiTest\Stub;

use Faker\Factory;
use Mineur\TwitterStreamApi\Model\Tweet;

/**
 * Class TweetStub
 * This Stub returns an hydrated tweet entity.
 *
 * @package Mineur\TwitterStreamApiTest\Stub
 */
class TweetEntityStub
{
    public static function create(array $tweet): Tweet
    {
        return Tweet::fromArray($tweet);
    }

    public static function random(): Tweet
    {
        $factory = Factory::create();

        return self::create([
            $factory->uuid(),                  /* uuid */
            $factory->text(),                /* text */
            $factory->languageCode(),        /* lang */
            $factory->dateTimeThisMonth(),   /* createdAt */
            $factory->unixTime(),            /* timestampMs */
            $factory->shuffleArray(),        /* geo */
            $factory->shuffleArray(),        /* coordinates */
            $factory->shuffleArray(),        /* places */
            $factory->numberBetween(0, 100), /* retweetCount */
            $factory->numberBetween(0, 100), /* favoriteCount */
            $factory->shuffleArray(),        /* entities */
            $factory->shuffleArray(),        /* extended_entities */
            $factory->shuffleArray()         /* user */
        ]);
    }
}