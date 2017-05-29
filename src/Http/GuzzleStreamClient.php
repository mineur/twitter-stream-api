<?php

namespace Mineur\TwitterStreamApi\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;


/**
 * Class GuzzleHttpClient
 * @package Mineur\TwitterStreamApi
 */
final class GuzzleStreamClient implements StreamClient
{
    /**
     * Api endpoint
     * @var string
     */
    const STREAMING_ENDPOINT = 'https://stream.twitter.com/1.1/';

    /** @var Client */
    private $client;

    /** @var Stream */
    private $streamBody;

    /**
     * GuzzleHttpClient constructor.
     *
     * @param string $consumerKey
     * @param string $consumerSecret
     * @param string $token
     * @param string $tokenSecret
     */
    public function __construct(
        string $consumerKey,
        string $consumerSecret,
        string $token,
        string $tokenSecret
    )
    {
        $stack = HandlerStack::create();
        $oauth = new Oauth1([
            'consumer_key'    => $consumerKey,
            'consumer_secret' => $consumerSecret,
            'token'           => $token,
            'token_secret'    => $tokenSecret,
        ]);

        $stack->push($oauth);
        $this->client = new Client([
            'base_uri' => self::STREAMING_ENDPOINT,
            'handler'  => $stack,
            'auth'     => 'oauth',
            'stream'   => true,
        ]);
    }

    /**
     * API Post request
     *
     * @param string $endpoint
     * @param array $options
     * @return mixed|\Psr\Http\Message\StreamInterface
     */
    public function post(
        string $endpoint,
        array $options
    )
    {
        $this->streamBody = $this->client
            ->post($endpoint, $options)
            ->getBody();
    }

    /**
     * Start reading the stream
     *
     * @return array
     */
    public function read(): array
    {
        while (!$this->streamBody->eof()) {
            $tweet = json_decode(
                $this->readStreamLine($this->streamBody),
                true
            );

            if (null !== $tweet) {
                return $tweet;
            }
        }
    }

    /**
     * @param Stream $stream
     * @param int|null $maxLength
     * @return string
     */
    private function readStreamLine(
        Stream $stream,
        int $maxLength = null
    ) : string
    {
        $buffer    = '';
        $size      = 0;
        $negEolLen = -strlen(PHP_EOL);

        while (!$stream->eof()) {
            if (false === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;

            if (++$size == $maxLength || substr($buffer, $negEolLen) === PHP_EOL) {
                break;
            }
        }

        return $buffer;
    }
}