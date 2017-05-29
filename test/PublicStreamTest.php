<?php

namespace Mineur\TwitterStreamApiTest;

use Mineur\TwitterStreamApi\Http\StreamClient;
use Mineur\TwitterStreamApi\PublicStream;
use Mockery\MockInterface;
use Mineur\TwitterStreamApi\Tweet;
use Mineur\TwitterStreamApiTest\Stub\StreamTweetArrayStub;
use Mineur\TwitterStreamApiTest\Stub\TweetEntityStub;
use Mineur\TwitterStreamApiTest\TestCase\UnitTestCase;

final class PublicStreamTest extends UnitTestCase
{
    /** @var StreamClient|MockInterface */
    private $streamClient;

    /** @var PublicStream|MockInterface */
    private $publicStream;

    /** Setup */
    public function setUp()
    {
        parent::setUp();

        $this->streamClient = $this->mock(StreamClient::class);
        $this->publicStream = $this->mock(PublicStream::class);
    }

    /** @test */
    public function it_should_return_tweet_object_when_start_consuming()
    {
        $streamTweetArray = StreamTweetArrayStub::create();
        $tweetEntityStub = TweetEntityStub::create($streamTweetArray);

        $this->returnTweetArraysWhenReadingStream($streamTweetArray);
        $this->openPublicStreamAndConsumming($tweetEntityStub);

        $this->assertInstanceOf(
            Tweet::class,
            $this->publicStream->consume()
        );
        $this->assertEquals(
            $tweetEntityStub,
            $this->publicStream->consume()
        );
    }

    private function openPublicStreamAndConsumming($tweetObject)
    {
        $this->publicStream
            ->shouldReceive([
                'open' => $this->streamClient,
                'consume' => null
            ])
            ->andReturn($tweetObject);
    }

    private function returnTweetArraysWhenReadingStream($streamTweetArray)
    {
        $this->streamClient
            ->shouldReceive('post')
            ->andReturn();
            //-> args

        $this->streamClient
            ->shouldReceive('read')
            ->once()
            ->andReturn($streamTweetArray);
    }
}