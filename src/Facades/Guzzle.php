<?php

namespace Sanchescom\Guzzle\Facades;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Facade;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * @method static ResponseInterface get(string|UriInterface $uri, array $options = [])
 * @method static ResponseInterface head(string|UriInterface $uri, array $options = [])
 * @method static ResponseInterface put(string|UriInterface $uri, array $options = [])
 * @method static ResponseInterface post(string|UriInterface $uri, array $options = [])
 * @method static ResponseInterface patch(string|UriInterface $uri, array $options = [])
 * @method static ResponseInterface delete(string|UriInterface $uri, array $options = [])
 * @method static Promise\PromiseInterface getAsync(string|UriInterface $uri, array $options = [])
 * @method static Promise\PromiseInterface headAsync(string|UriInterface $uri, array $options = [])
 * @method static Promise\PromiseInterface putAsync(string|UriInterface $uri, array $options = [])
 * @method static Promise\PromiseInterface postAsync(string|UriInterface $uri, array $options = [])
 * @method static Promise\PromiseInterface patchAsync(string|UriInterface $uri, array $options = [])
 * @method static Promise\PromiseInterface deleteAsync(string|UriInterface $uri, array $options = [])
 */
class Guzzle extends Facade
{
    /** @var string */
    protected static $client = Client::class;

    /** @var array */
    protected static $customConfig;

    /** @var array */
    protected static $defaultConfig;

    /**
     * {@inheritdoc}
     */
    public static function __callStatic($method, $args)
    {
        if (!empty(self::$customConfig)) {
            self::$customConfig = [];

            self::swap(new self::$client(self::getDefaultConfig()));
        }

        return parent::__callStatic($method, $args);
    }

    /**
     * Set custom config.
     *
     * @param array $config
     *
     * @return \GuzzleHttp\Client
     */
    public static function config(array $config = [])
    {
        self::$customConfig = $config;

        self::swap(new self::$client($config));

        return self::getFacadeRoot();
    }

    /**
     * @return array
     */
    public static function getDefaultConfig()
    {
        if (!empty(self::$defaultConfig)) {
            return self::$defaultConfig;
        }

        self::$defaultConfig = Config::get(self::getFacadeAccessor(), []);

        return self::$defaultConfig;
    }

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'guzzle';
    }
}
