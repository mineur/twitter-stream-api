<?php

namespace Mineur\TwitterStreamApi\Stream;

use Mineur\TwitterStreamApi\Stream\Stream;

/**
 * Class GuzzleStreamConnection
 * @package Mineur\TwitterStreamApi\Stream
 */
class GuzzleStream implements Stream
{
    public function read(
        $stream,
        int $maxLength = null
    ) : string
    {
        $buffer    = '';
        $size      = 0;
        $negEolLen = -strlen(PHP_EOL);

        while (!$stream->eof()) {
            if (false === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;

            if (++$size == $maxLength || substr($buffer, $negEolLen) === PHP_EOL) {
                break;
            }
        }

        return $buffer;
    }
}