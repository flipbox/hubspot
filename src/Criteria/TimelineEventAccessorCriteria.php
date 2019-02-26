<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

use Flipbox\HubSpot\Resources\TimelineEvent;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class TimelineEventAccessor extends AbstractCriteria
{
    use IdAttributeTrait,
        TypeIdAttributeTrait,
        IntegrationConnectionTrait,
        CacheTrait;

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     * @throws \Exception
     */
    public function read(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return TimelineEvent::read(
            $this->getId(),
            $this->getTypeId(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
