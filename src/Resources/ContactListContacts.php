<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Resources;

use Flipbox\HubSpot\Connections\ConnectionInterface;
use Flipbox\HubSpot\HubSpot;
use Flipbox\Relay\Builder\RelayBuilderInterface;
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
     * @param string $identifier
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function all(
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::allRelay(
            $identifier,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $identifier
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function allRelay(
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new All(
            $identifier,
            $connection ?: HubSpot::getConnection(),
            $cache ?: HubSpot::getCache(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * ADD
     *******************************************/

    /**
     * @param string $identifier
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function add(
        string $identifier,
        array $payload,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::addRelay(
            $identifier,
            $payload,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $identifier
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function addRelay(
        string $identifier,
        array $payload,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        /** @var RelayBuilderInterface $builder */
        $builder = new Add(
            $identifier,
            $payload,
            $connection ?: HubSpot::getConnection(),
            $cache ?: HubSpot::getCache(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * REMOVE
     *******************************************/

    /**
     * @param string $identifier
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function remove(
        string $identifier,
        array $payload,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::removeRelay(
            $identifier,
            $payload,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $identifier
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function removeRelay(
        string $identifier,
        array $payload,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        /** @var RelayBuilderInterface $builder */
        $builder = new Remove(
            $identifier,
            $payload,
            $connection ?: HubSpot::getConnection(),
            $cache ?: HubSpot::getCache(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }
}
