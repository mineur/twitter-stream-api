<?php

namespace Alexhoma\TwitterStreamApi;

/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Alexhoma\TwitterStreamApi
 */
class PublicStream
{
    const METHOD_FILTER = 'filter';

    private $keywords;

    private $endpoints = [
        'filter' => 'https://stream.twitter.com/1.1/statuses/filter.json',
    ];

    public function __construct(array $keywords)
    {
        $this->keywords = $keywords;
    }

    public function track()
    {
        // start tracking twitter
    }
}