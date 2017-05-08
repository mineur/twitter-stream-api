<?php

namespace Alexhoma\TwitterStreamApi;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\StreamInterface;
use SebastianBergmann\CodeCoverage\Report\PHP;


/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Alexhoma\TwitterStreamApi
 */
final class PublicStream
{
    /** @var HttpClient */
    private $httpClient;

    /**
     * PublicStream constructor.
     * @param \Alexhoma\TwitterStreamApi\HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Open stream
     *
     * @param array $keyword
     * @return mixed
     */
    public function open(array $keyword)
    {
        $body = $this->listenFor($keyword);

        while (!$body->eof()) {
            $tweet = json_decode(
                $this->readStreamLine($body),
                true
            );

            echo $tweet['text'].PHP_EOL;
        }
    }

    /**
     * Listen for unique keyword
     *
     * @todo add keywords array
     * @param array $keywords
     * @return StreamInterface
     */
    private function listenFor(array $keywords)
    {
        $client = $this->httpClient;
        $keywords = implode(',', $keywords);

        return $client()->post('statuses/filter.json', [
            'form_params' => [
                'track' => $keywords,
            ],
        ])->getBody();
    }

    /**
     * Read Stream Line
     *
     * @param Stream $stream
     * @param int|null $maxLength
     * @return string
     */
    private function readStreamLine(
        Stream $stream,
        int $maxLength = null
    ) {
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