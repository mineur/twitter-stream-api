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
final class GuzzleHttpClient implements HttpClient
{
    /**
     * Api endpoint
     * @var string
     */
    const STREAMING_ENDPOINT = 'https://stream.twitter.com/1.1/';

    /** @var Oauth1 */
    private $oauth;

    /** @var HandlerStack */
    private $stack;

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
        $this->stack = HandlerStack::create();
        $this->oauth = new Oauth1([
            'consumer_key'    => $consumerKey,
            'consumer_secret' => $consumerSecret,
            'token'           => $token,
            'token_secret'    => $tokenSecret,
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
    ) : array
    {
        $this->stack->push($this->oauth);

        $client = new Client([
            'base_uri' => self::STREAMING_ENDPOINT,
            'handler'  => $this->stack,
            'auth'     => 'oauth',
            'stream'   => true,
        ]);

        $body = $client
            ->post($endpoint, $options)
            ->getBody();

        while (!$body->eof()) {
            $tweet = json_decode(
                $this->readStreamLine($body),
                true
            );

            return $tweet;
            $this->returnResponse($tweet);
        }
    }

    public function returnResponse($tweet)
    {
        dump($tweet);
        return $tweet;
    }

    /**
     * @param Stream $stream
     * @param int|null $maxLength
     * @return string
     */
    public function readStreamLine(
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