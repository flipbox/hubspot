<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot;

use Flipbox\HubSpot\Connections\ConnectionInterface;
use Flipbox\HubSpot\Connections\IntegrationConnectionInterface;
use Flipbox\Skeleton\Logger\StaticLoggerTrait;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class HubSpot
{
    use StaticLoggerTrait;

    /**
     * @var CacheInterface
     */
    private static $cache;

    /**
     * @var ConnectionInterface
     */
    private static $connection;

    /**
     * @var IntegrationConnectionInterface
     */
    private static $integrationConnection;

    /**
     * @var LoggerInterface
     */
    private static $logger;


    /*******************************************
     * LOGGER
     *******************************************/

    /**
     * Get a logger
     *
     * @return LoggerInterface|null
     */
    public static function getLogger()
    {
        return self::$logger;
    }

    /**
     * Set a logger
     *
     * @param LoggerInterface|null $logger
     */
    public static function setLogger(LoggerInterface $logger = null)
    {
        self::$logger = $logger;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     */
    public static function log($level, $message, array $context = [])
    {
        if (null !== ($logger = static::getLogger())) {
            $logger->log($level, $message, $context);
        }
    }


    /*******************************************
     * CACHE
     *******************************************/

    /**
     * Get the cache
     *
     * @return CacheInterface
     */
    public static function getCache(): CacheInterface
    {
        return self::$cache;
    }

    /**
     * Set the cache
     *
     * @param CacheInterface $cache
     */
    public static function setCache(CacheInterface $cache)
    {
        self::$cache = $cache;
    }


    /*******************************************
     * CONNECTION
     *******************************************/

    /**
     * Get the connection
     *
     * @return ConnectionInterface
     */
    public static function getConnection(): ConnectionInterface
    {
        return self::$connection;
    }

    /**
     * Set the connection
     *
     * @param ConnectionInterface $connection
     */
    public static function setConnection(ConnectionInterface $connection)
    {
        self::$connection = $connection;
    }


    /*******************************************
     * INTEGRATION CONNECTION
     *******************************************/

    /**
     * Get the integration connection
     *
     * @return IntegrationConnectionInterface
     */
    public static function getIntegrationConnection(): IntegrationConnectionInterface
    {
        return self::$integrationConnection;
    }

    /**
     * Set the integration connection
     *
     * @param IntegrationConnectionInterface $integrationConnection
     */
    public static function setIntegrationConnection(IntegrationConnectionInterface $integrationConnection)
    {
        self::$integrationConnection = $integrationConnection;
    }
}
