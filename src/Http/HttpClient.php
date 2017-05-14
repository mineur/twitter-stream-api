<?php

namespace Mineur\TwitterStreamApi\Http;

interface HttpClient
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
    ): array;

    /**
     * Checks if Stream line is at the end of the file
     *
     * @return bool
     */
//    public function isStreamAtTheEndOfFile(): bool;
}