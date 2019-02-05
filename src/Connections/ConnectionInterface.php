<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Connections;

use Flipbox\Relay\HubSpot\AuthorizationInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
interface ConnectionInterface extends AuthorizationInterface
{
    /**
     * The HubSpot hub Id
     *
     * @return string
     */
    public function getHubId(): string;
}
