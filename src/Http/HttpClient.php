<?php

namespace Mineur\TwitterStreamApi\Http;

interface HttpClient
{
    /**
     * Post
     *
     * @param string $endpoint
     * @param array $options
     * @return mixed
     */
    public function post(
        string $endpoint,
        array $options
    );
}