<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Resources;

use Flipbox\HubSpot\Connections\ConnectionInterface;
use Flipbox\HubSpot\HubSpot;
use Flipbox\Relay\HubSpot\Builder\Resources\Company\Create;
use Flipbox\Relay\HubSpot\Builder\Resources\Company\Delete;
use Flipbox\Relay\HubSpot\Builder\Resources\Company\Read;
use Flipbox\Relay\HubSpot\Builder\Resources\Company\Update;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class Company
{

    /*******************************************
     * CREATE
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param array $payload
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function create(
        ConnectionInterface $connection,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::createRelay(
            $connection,
            $payload,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param array $payload
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function createRelay(
        ConnectionInterface $connection,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Create(
            $payload,
            $connection,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }

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
        $builder = new Read(
            $identifier,
            $connection,
            $cache,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * UPDATE
     *******************************************/

    /**
     * @param string $identifier
     * @param array $payload
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function update(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::updateRelay(
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
    public static function updateRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Update(
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
     * UPSERT
     *******************************************/

    /**
     * @param string|null $identifier
     * @return bool
     */
    protected static function upsertHasId(string $identifier = null): bool
    {
        return !empty($identifier);
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param array $payload
     * @param string|null $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function upsert(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::upsertRelay(
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
     * @param string|null $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function upsertRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        array $payload,
        string $identifier = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        if (!static::upsertHasId($identifier)) {
            return static::createRelay(
                $connection,
                $payload,
                $logger,
                $config
            );
        }

        return static::updateRelay(
            $connection,
            $cache,
            $payload,
            $identifier,
            $logger,
            $config
        );
    }


    /*******************************************
     * DELETE
     *******************************************/

    /**
     * @param string $identifier
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function delete(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::deleteRelay(
            $connection,
            $cache,
            $identifier,
            $logger,
            $config
        )();
    }

    /**
     * @param string $identifier
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function deleteRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Delete(
            $identifier,
            $connection,
            $cache,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }
}
