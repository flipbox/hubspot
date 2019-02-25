<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

use Flipbox\HubSpot\Resources\ContactListContacts;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class ContactListContactsAccessorCriteria extends AbstractObjectAccessor
{
    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function all(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return ContactListContacts::all(
            $this->getId(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}