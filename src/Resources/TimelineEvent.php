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
    /**
     * @param string $id
     * @param string $typeId
     * @param IntegrationConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function read(
        string $id,
        string $typeId,
        IntegrationConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::readRelay(
            $id,
            $typeId,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $id
     * @param string $typeId
     * @param IntegrationConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function readRelay(
        string $id,
        string $typeId,
        IntegrationConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        $connection = $connection ?: HubSpot::getIntegrationConnection();

        $builder = new Read(
            $connection->getAppId(),
            $typeId,
            $id,
            $connection,
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
     * @param string $typeId
     * @param string $id
     * @param array $payload
     * @param IntegrationConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function upsert(
        string $id,
        string $typeId,
        array $payload,
        IntegrationConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::upsertRelay(
            $id,
            $typeId,
            $payload,
            $connection,
            $cache,
            $logger,
            $config
        )();
    }

    /**
     * @param string $typeId
     * @param string $id
     * @param array $payload
     * @param IntegrationConnectionInterface|null $connection
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function upsertRelay(
        string $id,
        string $typeId,
        array $payload,
        IntegrationConnectionInterface $connection = null,
        CacheInterface $cache = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {

        $payload['id'] = $id;
        $payload['eventTypeId'] = $typeId;

        $connection = $connection ?: HubSpot::getIntegrationConnection();

        $builder = new Upsert(
            $connection->getAppId(),
            $typeId,
            $id,
            $payload,
            $connection,
            $cache ?: HubSpot::getCache(),
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }


    /*******************************************
     * BATCH
     *******************************************/

    /**
     * @param array $payload
     * @param IntegrationConnectionInterface|null $connection
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function batch(
        array $payload,
        IntegrationConnectionInterface $connection = null,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::batchRelay(
            $payload,
            $connection,
            $logger,
            $config
        )();
    }

    /**
     * @param array $payload
     * @param IntegrationConnectionInterface|null $connection
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function batchRelay(
        array $payload,
        IntegrationConnectionInterface $connection = null,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $connection = $connection ?: HubSpot::getIntegrationConnection();

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
