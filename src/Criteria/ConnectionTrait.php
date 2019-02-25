<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

use Flipbox\HubSpot\Connections\ConnectionInterface;
use Flipbox\HubSpot\HubSpot;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
trait ConnectionTrait
{
    /**
     * @var ConnectionInterface|null
     */
    protected $connection;

    /**
     * @param $value
     * @return $this
     */
    public function connection($value)
    {
        return $this->setConnection($value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setConnection($value)
    {
        $this->connection = $value;
        return $this;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection = $this->resolveConnection($this->connection);
    }

    /**
     * @param $connection
     * @return ConnectionInterface
     */
    protected static function resolveConnection($connection)
    {
        if ($connection instanceof ConnectionInterface) {
            return $connection;
        }

        return HubSpot::getConnection();
    }
}
