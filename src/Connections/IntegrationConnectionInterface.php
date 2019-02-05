<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Connections;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
interface IntegrationConnectionInterface extends ConnectionInterface
{
    /**
     * The HubSpot App Id
     *
     * @return string
     */
    public function getAppId(): string;
}
