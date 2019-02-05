<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Resources;

use Flipbox\HubSpot\Connections\ConnectionInterface;
use Flipbox\HubSpot\HubSpot;
use Flipbox\Relay\HubSpot\Builder\Resources\Company\Contacts\Add;
use Flipbox\Relay\HubSpot\Builder\Resources\Company\Contacts\All;
use Flipbox\Relay\HubSpot\Builder\Resources\Company\Contacts\Remove;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class CompanyContacts
{
    /*******************************************
     * READ
     *******************************************/

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $companyId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function read(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $companyId,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::readRelay(
            $connection,
            $cache,
            $companyId,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $companyId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function readRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $companyId,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new All(
            $companyId,
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
     * @param string $companyId
     * @param string $contactId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function add(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $companyId,
        string $contactId,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::addRelay(
            $connection,
            $cache,
            $companyId,
            $contactId,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $companyId
     * @param string $contactId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function addRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $companyId,
        string $contactId,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Add(
            $companyId,
            $contactId,
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
     * @param string $companyId
     * @param string $contactId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return ResponseInterface
     */
    public static function remove(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $companyId,
        string $contactId,
        LoggerInterface $logger = null,
        array $config = []
    ): ResponseInterface {
        return static::removeRelay(
            $connection,
            $cache,
            $companyId,
            $contactId,
            $logger,
            $config
        )();
    }

    /**
     * @param ConnectionInterface $connection
     * @param CacheInterface $cache
     * @param string $companyId
     * @param string $contactId
     * @param LoggerInterface|null $logger
     * @param array $config
     * @return callable
     */
    public static function removeRelay(
        ConnectionInterface $connection,
        CacheInterface $cache,
        string $companyId,
        string $contactId,
        LoggerInterface $logger = null,
        array $config = []
    ): callable {
        $builder = new Remove(
            $companyId,
            $contactId,
            $connection,
            $cache,
            $logger ?: HubSpot::getLogger(),
            $config
        );

        return $builder->build();
    }
}
