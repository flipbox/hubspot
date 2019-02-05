<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Resources;

use Flipbox\HubSpot\Connections\IntegrationConnectionInterface;
use Flipbox\HubSpot\HubSpot;
use Flipbox\Relay\HubSpot\Builder\Resources\Timeline\Event\Batch;
use Flipbox\Relay\HubSpot\Builder\Resources\Timeline\Event\Read;
use Flipbox\Relay\HubSpot\Builder\Resources\Timeline\Event\Upsert;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class TimelineEvent
{
    /*******************************************
     * READ
     *******************************************/

    /**
     * @param IntegrationConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $identifier
     * @param string $typeId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function read(
        IntegrationConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        string $typeId,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::readRelay(
            $connection,
            $cache,
            $identifier,
            $typeId,
            $logger,
            $config
        )();
    }

    /**
     * @param IntegrationConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $identifier
     * @param string $typeId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function readRelay(
        IntegrationConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        string $typeId,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Read(
            $connection->getAppId(),
            $typeId,
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
     * @param IntegrationConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $identifier
     * @param string $typeId
     * @param array $payload
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function upsert(
        IntegrationConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        string $typeId,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::upsertRelay(
            $connection,
            $cache,
            $identifier,
            $typeId,
            $payload,
            $logger,
            $config
        )();
    }

    /**
     * @param IntegrationConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $identifier
     * @param string $typeId
     * @param array $payload
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function upsertRelay(
        IntegrationConnectionInterface $connection,
        CacheInterface $cache,
        string $identifier,
        string $typeId,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Upsert(
            $connection->getAppId(),
            $typeId,
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
     * BATCH
     *******************************************/

    /**
     * @param IntegrationConnectionInterface $connection
     * @param array $payload
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function batch(
        IntegrationConnectionInterface $connection,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::batchRelay(
            $connection,
            $payload,
            $logger,
            $config
        )();
    }

    /**
     * @param IntegrationConnectionInterface $connection
     * @param array $payload
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function batchRelay(
        IntegrationConnectionInterface $connection,
        array $payload,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Batch(
            $connection->getAppId(),
            $payload,
            $connection,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }
}
