<?php

namespace Mineur\TwitterStreamApiTest\Stub;

use Mineur\TwitterStreamApi\Http\StreamClient;
use Mineur\TwitterStreamApi\PublicStream;

class PublicStreamTestClass extends PublicStream
{
    protected $streamClient;

    /**
     * PublicStream constructor.
     *
     * @param StreamClient $streamClient
     */
    protected function __construct(StreamClient $streamClient)
    {
        $this->streamClient = $streamClient;
    }

    /**
     * Open the stream connection
     *
     * @param StreamClient $streamClient
     * @return PublicStreamTestClass
     */
    public static function open(StreamClient $streamClient)
    {
        return new self($streamClient);
    }

    public function consume()
    {
        die('dfsdgdsfgsdf');
    }
}