<?php

namespace Mineur\TwitterStreamApi;

use Mineur\TwitterStreamApi\Exception\EmptyKeywordsException;
use Mineur\TwitterStreamApi\Http\GuzzleStreamClient;
use Mineur\TwitterStreamApi\Http\StreamClient;


/**
 * Class PublicStream
 * Offers samples of the public data flowing through Twitter.
 *
 * @package Mineur\TwitterStreamApi
 */
class PublicStream
{
    /** Filter method endpoint */
    const FILTER_METHOD = 'statuses/filter.json';
    
    /** @var GuzzleStreamClient */
    protected $streamClient;

    /** @var $language */
    private $language;

    /** @var $keywords */
    private $keywords;

    /** @var $users */
    private $users;

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
     * @return PublicStream
     */
    public static function open(StreamClient $streamClient): self
    {
        return new self($streamClient);
    }
    
    /**
     * Set the stream connection
     * plus set all filter params
     *
     * @return void
     */
    private function setStreamClient()
    {
        $language = $this->language ?? '';
        $keywords = $this->keywords ?? [];
        $users    = $this->users ?? [];
    
        $this->streamClient->post(self::FILTER_METHOD, [
            'form_params' => [
                'language' => $language,
                'track'    =>  implode(',', $keywords),
                'follow'    => implode(',', $users),
            ],
        ]);
    }

    /**
     * Start consuming the Stream API
     *
     * @return void
     */
    public function consume()
    {
        $this->setStreamClient();
        
        while (true) {
            $this->consumeOnce();
        }
    }
    
    /**
     * Start consuming the Stream API
     * And return a callback function
     *
     * @param callable $callback
     * @return void
     */
    public function do(callable $callback)
    {
        $this->setStreamClient();
        
        while (true) {
            $this->consumeOnce($callback);
        }
    }
    
    /**
     * Consume once from the stream
     * Can return a callable or not depending on the entry point
     *  - consume()
     *  - do($callable)
     *
     * @param callable $callback
     * @return Tweet|mixed
     */
    private function consumeOnce(callable $callback = null)
    {
        $tweet = $this->streamClient->read();
        
        if ($callback !== null) {
            return call_user_func($callback, Tweet::fromArray($tweet));
        }
        
        return Tweet::fromArray($tweet);
    }
    
    /**
     * Set keywords to track
     *
     * @param array $keywords
     * @return PublicStream
     * @throws EmptyKeywordsException
     */
    public function listenFor(array $keywords): self
    {
        if (empty($keywords)) {
            throw new EmptyKeywordsException(
                'The keywords array to listen for it mustn\'t be empty.'
            );
        }
        
        $this->keywords = $keywords;

        return $this;
    }
    
    /**
     * Set Tweet search language
     *
     * @param string $language
     * @return PublicStream
     */
    public function setLanguage(? string $language): self
    {
        $this->language = $language;
        
        return $this;
    }

    /**
     * Set a User Id filter
     * to track user posts
     *
     * @param array $users
     * @return PublicStream
     */
    public function tweetedBy(? array $users): self
    {
        $this->users = $users;

        return $this;
    }
}
