<?php

namespace Mineur\TwitterStreamApiTest;

use Mineur\TwitterStreamApi\Http\StreamClient;
use Mineur\TwitterStreamApi\PublicStream;
use Mineur\TwitterStreamApi\Tweet;
use Mineur\TwitterStreamApiTest\Stub\StreamTweetArrayStub;
use Mineur\TwitterStreamApiTest\Stub\TweetEntityStub;
use Mockery\MockInterface;

final class PublicStreamTest extends UnitTestCase
{
    /** @var MockInterface|StreamClient */
    private $streamClient;

    /** @var PublicStream */
    private $publicStream;

    public function setUp()
    {
        parent::setUp();

        $this->streamClient = $this->mock(StreamClient::class);
        $this->publicStream = PublicStream::open($this->streamClient);
    }

    /** @test */
    public function it_should_return_tweet_object_when_start_consuming()
    {
        $streamTweetArray = StreamTweetArrayStub::create();
        $tweetEntityStub = TweetEntityStub::create($streamTweetArray);

        $this->shouldReturnEmptyOnStreamClientPost(
            'statuses/filter.json',
            'hola'
        );
        $this->shouldReturnTweetObjectOnStreamConsuming($streamTweetArray);

        $this->publicStream->listenFor(['hola']);
        $this->assertInstanceOf(
            Tweet::class,
            $this->publicStream->consume()
        );
        $this->assertEquals(
            $tweetEntityStub,
            $this->publicStream->consume()
        );
    }

    private function shouldReturnEmptyOnStreamClientPost(
        string $endpoint,
        string $track
    )
    {
        $this->streamClient
            ->shouldReceive('post')
            ->with($endpoint, [
                'form_params' => [
                    'track' => $track
                ]
            ])
            ->once();
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