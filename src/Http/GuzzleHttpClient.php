<?php

namespace Mineur\TwitterStreamApi\Http;

use GuzzleHttp\Client;
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
     * Invoke method.
     *
     * @param string $endpoint
     * @param array $options
     * @return mixed|\Psr\Http\Message\StreamInterface
     */
    public function post(string $endpoint, array $options)
    {
        $this->stack->push($this->oauth);

        $client = new Client([
            'base_uri' => self::STREAMING_ENDPOINT,
            'handler'  => $this->stack,
            'auth'     => 'oauth',
            'stream'   => true,
        ]);

        return $client
            ->post($endpoint, $options)
            ->getBody();
    }
}