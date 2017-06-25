<?php

/*
 * Mineur/twitter-stream-api package
 *
 * Feel free to contribute!
 *
 * @license MIT
 * @author alexhoma <alexcm.14@gmail.com>
 */

namespace Mineur\TwitterStreamApi\Http;

interface StreamClient
{
    /**
     * Post request
     *
     * @param string $endpoint
     * @param array $options
     * @return mixed
     */
    public function post(
        string $endpoint,
        array $options
    );

    /**
     * Read stream
     *
     * @return array
     */
    public function read(): array;
}