<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

use Flipbox\HubSpot\Resources\Contact;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class ContactMutatorCriteria extends AbstractObjectMutator
{
    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function create(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Contact::create(
            $this->getPayload(),
            $this->getConnection(),
            $this->getLogger(),
            $config
        );
    }

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function update(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Contact::update(
            $this->getPayload(),
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
     */
    public function upsert(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Contact::upsert(
            $this->getPayload(),
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
     */
    public function delete(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Contact::delete(
            $this->getId(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
