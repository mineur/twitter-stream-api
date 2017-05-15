<?php

namespace Mineur\TwitterStreamApiTest;

use Mockery\MockInterface;
use Mineur\TwitterStreamApi\Tweet;
use Mineur\TwitterStreamApi\Http\StreamClient;
use Mineur\TwitterStreamApiTest\Mock\PublicStreamTestClass;
use Mineur\TwitterStreamApiTest\Stub\StreamTweetArrayStub;
use Mineur\TwitterStreamApiTest\Stub\TweetEntityStub;
use Mineur\TwitterStreamApiTest\TestCase\UnitTestCase;

final class PublicStreamTest extends UnitTestCase
{
    /** @var MockInterface|StreamClient */
    private $streamClient;

    /** @var PublicStreamTestClass */
    private $publicStreamMock;

    public function setUp()
    {
        parent::setUp();

        $this->streamClient = $this->mock(StreamClient::class);
        $this->publicStreamMock = PublicStreamTestClass::open($this->streamClient);
    }

    /** @test */
    public function it_should_return_tweet_object_when_start_consuming()
    {
        $streamTweetArray = StreamTweetArrayStub::create();
        $tweetEntityStub = TweetEntityStub::create($streamTweetArray);

        $this->shouldReturnNullOnStreamClientPost();
        $this->shouldReturnTweetObjectOnStreamConsuming($streamTweetArray);

        $this->assertInstanceOf(
            Tweet::class,
            $this->publicStreamMock->consume()
        );
        $this->assertEquals(
            $tweetEntityStub,
            $this->publicStreamMock->consume()
        );
    }

    private function shouldReturnNullOnStreamClientPost()
    {
        $this->streamClient
            ->shouldReceive('post')
            ->once()
            ->andReturnNull();
    }

    private function shouldReturnTweetObjectOnStreamConsuming(
        array $streamTweet
    )
    {
        $this->streamClient
            ->shouldReceive('read')
            ->once()
            ->andReturn($streamTweet);
    }
}