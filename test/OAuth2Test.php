<?php

namespace Alexhoma\TwitterStreamApiTest;

use Alexhoma\TwitterStreamApi\OAuth2;
use PHPUnit\Framework\TestCase;


final class OAuth2Test extends TestCase
{
    /** @test */
    public function it_should_return_a_guzzle_client_instance()
    {
        $instance = (new OAuth2(
            'bTlijKb4c6vnGS1skdZQo5ch0',
            'PNGiXkQta5pa2T0XCEGNCxBniZe94vyK0GbXUtEX2Y7GynNX6Y'
        ))->execute();

        $this->assertInstanceOf(
            'GuzzleHttp\Client', $instance,
            'OAuthConnector should return a Guzzle/Client instance'
        );
    }
}