<?php

namespace Alexhoma\TwitterStreamApi;

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;


/**
 * Class HttpClient
 * @package Alexhoma\TwitterStreamApi
 */
final class HttpClient
{
    /**
     * Api endpoint
     * @var string
     */
    const STREAMING_ENDPOINT = 'https://stream.twitter.com/1.1';

    /** @var Oauth1 */
    private $oauth;

    /** @var HandlerStack */
    private $stack;

    /**
     * HttpClient constructor.
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

        $this->stack = $stack;
    }

    /**
     * Invoke method.
     *
     * @return Client
     */
    public function __invoke(): Client
    {
        return new Client([
            'base_uri' => self::STREAMING_ENDPOINT,
            'handler'  => $this->stack,
            'auth'     => 'oauth',
            'stream'   => true,
        ]);
    }
}