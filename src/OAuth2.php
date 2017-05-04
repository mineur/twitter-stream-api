<?php

namespace Alexhoma\TwitterStreamApi;

use CommerceGuys\Guzzle\Oauth2\GrantType\ClientCredentials;
use CommerceGuys\Guzzle\Oauth2\GrantType\RefreshToken;
use CommerceGuys\Guzzle\Oauth2\Oauth2Subscriber;
use GuzzleHttp\Client;

/**
 * Class OAuth2
 * @package Alexhoma\TwitterStreamApi
 */
final class OAuth2
{
    /**
     * Base Twitter Url
     */
    const BASE_URL = 'https://stream.twitter.com';

    /**
     * @var string
     */
    private $consumerKey;

    /**
     * @var string
     */
    private $consumerSecret;

    /**
     * OAuth2 constructor.
     * @param string $consumerKey
     * @param string $consumerSecret
     */
    public function __construct(
        string $consumerKey,
        string $consumerSecret
    )
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
    }

    /**
     * Execute OAuth2 Authentication
     * @return Client
     */
    public function execute(): Client
    {
        $oauth2Client = new Client(['base_url' => self::BASE_URL]);
        $config_parameters = [
            'client_id'     => $this->consumerKey,
            'client_secret' => $this->consumerSecret,
            'token_url'     => '/oauth2/token'
        ];
        $token        = new ClientCredentials($oauth2Client, $config_parameters);
        $refreshToken = new RefreshToken($oauth2Client, $config_parameters);
        $oauth2       = new Oauth2Subscriber($token, $refreshToken);

        $client = new Client([
                'base_url' => self::BASE_URL,
                'defaults' => [
                    'auth'        => 'oauth2',
                    'subscribers' => [$oauth2],
                ],
            ]
        );

        return $client;
    }
}