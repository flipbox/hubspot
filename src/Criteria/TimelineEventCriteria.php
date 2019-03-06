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
class TimelineEventCriteria extends AbstractCriteria
{
    use CacheTrait,
        IdAttributeTrait,
        TypeIdAttributeTrait,
        IntegrationConnectionTrait,
        PayloadAttributeTrait;

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

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     * @throws \Exception
     */
    public function upsert(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return TimelineEvent::upsert(
            $this->getId(),
            $this->getTypeId(),
            $this->getPayload(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
