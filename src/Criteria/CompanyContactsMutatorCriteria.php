<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

use Flipbox\HubSpot\Resources\CompanyContacts;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
class CompanyContactsMutatorCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait;

    /**
     * @var string
     */
    public $companyId;

    /**
     * @var string
     */
    public $contactId;

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return (string)$this->companyId;
    }

    /**
     * @return string
     */
    public function getContactId(): string
    {
        return (string)$this->contactId;
    }

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     */
    public function add(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return CompanyContacts::add(
            $this->getCompanyId(),
            $this->getContactId(),
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
    public function remove(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return CompanyContacts::remove(
            $this->getCompanyId(),
            $this->getContactId(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
