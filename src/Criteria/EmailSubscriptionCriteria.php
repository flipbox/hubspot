<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

use Flipbox\HubSpot\Resources\EmailSubscriptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.4.0
 */
class EmailSubscriptionCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait,
        IdAttributeTrait,
        PayloadAttributeTrait;

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     * @throws \Exception
     */
    public function list(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return EmailSubscriptions::list(
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
    public function read(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return EmailSubscriptions::read(
            $this->getId(),
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
    public function update(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return EmailSubscriptions::update(
            $this->getId(),
            $this->getPayload(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
