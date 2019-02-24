<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Resources;

use Flipbox\HubSpot\Connections\ConnectionInterface;
use Flipbox\HubSpot\HubSpot;
use Flipbox\Relay\HubSpot\Builder\Resources\Limit\Daily\Read;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class Hub
{
    /*******************************************
     * DAILY LIMIT
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function dailyLimit(
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::dailyLimitRelay(
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function dailyLimitRelay(
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Read(
            $connection ?: HubSpot::getConnection(),
            $cache ?: HubSpot::getCache(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }
}
