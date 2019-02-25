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
class ContactBatchMutator extends AbstractCriteria
{
    use ConnectionTrait,
        PayloadAttributeTrait;

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function batch(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return Contact::batch(
            $this->getPayload(),
            $this->getConnection(),
            $this->getLogger(),
            $config
        );
    }
}
