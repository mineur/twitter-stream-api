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
        $tweetArray = StreamTweetArrayStub::random();
        
        return self::create($tweetArray);
    }
}