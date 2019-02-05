<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Resources;

use Flipbox\HubSpot\Connections\ConnectionInterface;
use Flipbox\HubSpot\HubSpot;
use Flipbox\Relay\HubSpot\Builder\Resources\ContactList\Contacts\Add;
use Flipbox\Relay\HubSpot\Builder\Resources\ContactList\Contacts\All;
use Flipbox\Relay\HubSpot\Builder\Resources\ContactList\Contacts\Remove;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class ContactListContacts
{
    /*******************************************
     * READ
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function read(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::readRelay(
            $connection,
            $cache,
            $identifier,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function readRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new All(
            $identifier,
            $connection,
            $cache,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * ADD
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param array $payload
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function add(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::addRelay(
            $connection,
            $cache,
            $payload,
            $identifier,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param array $payload
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function addRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Add(
            $identifier,
            $payload,
            $connection,
            $cache,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * REMOVE
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param array $payload
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function remove(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::removeRelay(
            $connection,
            $cache,
            $payload,
            $identifier,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param array $payload
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function removeRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Remove(
            $identifier,
            $payload,
            $connection,
            $cache,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }
}
