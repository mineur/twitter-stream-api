<?php

namespace Mineur\TwitterStreamApiTest\Mock;

use Mineur\TwitterStreamApi\PublicStream;
use Mineur\TwitterStreamApi\Tweet;

/**
 * Class PublicStreamMock
 * Public Stream extension to mock a single output of the stream
 * since consume() method returns an infinite loop.
 *
 * @package Mineur\TwitterStreamApiTest\Mock
 */
class PublicStreamTestClass extends PublicStream
{
    public function consume()
    {
        $tweet = $this->streamClient->read();
        $this->returnTweetObject($tweet);
    }

    protected function returnTweetObject(array $tweet): Tweet
    {
        return Tweet::fromArray(1);
    }
}