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
use Flipbox\Relay\HubSpot\Builder\Resources\Company\ListByDomain;
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
    /**
     * @param string|null $identifier
     * @return bool
     */
    protected static function upsertHasId(string $identifier = null): bool
    {
        return !empty($identifier);
    }

    /*******************************************
     * CREATE
     *******************************************/

    /**
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function create(
        array $payload,
        ConnectionInterface $connection = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::createRelay(
            $payload,
            $connection,
            $logger,
            $config
        )();
    }

    /**
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function createRelay(
        array $payload,
        ConnectionInterface $connection = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        $builder = new Create(
            $payload,
            $connection ?: HubSpot::getConnection(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * READ
     *******************************************/

    /**
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function read(
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::readRelay(
            $identifier,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param string $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function readRelay(
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        $builder = new Read(
            $identifier,
            $connection ?: HubSpot::getConnection(),
            $cache ?: HubSpot::getCache(),
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
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function update(
        array $payload,
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::updateRelay(
            $payload,
            $identifier,
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
    public static function updateRelay(
        array $payload,
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        $builder = new Update(
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
     * UPSERT
     *******************************************/

    /**
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param array $payload
     * @param string|null $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function upsert(
        array $payload,
        string $identifier = null,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::upsertRelay(
            $payload,
            $identifier,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param array $payload
     * @param string|null $identifier
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function upsertRelay(
        array $payload,
        string $identifier = null,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        if (!static::upsertHasId($identifier)) {
            return static::createRelay(
                $payload,
                $connection,
                $logger,
                $config
            );
        }

        return static::updateRelay(
            $payload,
            $identifier,
            $connection,
            $cache,
            $logger,
            $config
        );
    }


    /*******************************************
     * DELETE
     *******************************************/

    /**
     * @param string $identifier
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function delete(
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::deleteRelay(
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
     * @param LoggerInterface $logger
     * @param array $config
     * @return callable
     */
    public static function deleteRelay(
        string $identifier,
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        $builder = new Delete(
            $identifier,
            $connection ?: HubSpot::getConnection(),
            $cache ?: HubSpot::getCache(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * LIST (by Domain)
     *******************************************/

    /**
     * @param string $domain
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function listByDomain(
        string $domain,
        array $payload = [],
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::listByDomainRelay(
            $domain,
            $payload,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $domain
     * @param array $payload
     * @param ConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function listByDomainRelay(
        string $domain,
        array $payload = [],
        ConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        $builder = new ListByDomain(
            $domain,
            $payload,
            $connection ?: HubSpot::getConnection(),
            $cache ?: HubSpot::getCache(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }
}
