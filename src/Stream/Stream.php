<?php

namespace Mineur\TwitterStreamApi\Stream;

/**
 * Interface StreamConnection
 * @package Mineur\TwitterStreamApi\Stream
 */
interface Stream
{
    public function read($stream): string;
}