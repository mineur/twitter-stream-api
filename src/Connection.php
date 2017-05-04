<?php

namespace Alexhoma\TwitterStreamApi;


use Exception;

class Connection
{
    const HOST_NAME = 'ssl://stream.twitter.com';
    const SSL_PORT = 443;
    const CONNECTION_TIMEOUT = 30;

    private function openSocketCopnnection()
    {
        $socketConnection = fsockopen(
            self::HOST_NAME,
            self::SSL_PORT,
            $errorCode, $errorText,
            self::CONNECTION_TIMEOUT
        );

        if (false === $socketConnection) {
            throw new Exception(
                'Twitter Stream Api error. Failed to open socket.'
            );
        }
    }
}