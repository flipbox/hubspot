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
class CompanyContactsCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait,
        IdAttributeTrait;

    /**
     * @var string|null
     */
    protected $contactId;

    /**
     * @return string
     * @throws \Exception
     */
    public function getContactId(): string
    {
        if (null === ($id = $this->findContactId())) {
            throw new \Exception("Invalid Contact Id");
        }
        return (string)$id;
    }

    /**
     * @return string|null
     */
    public function findContactId()
    {
        return $this->contactId;
    }

    /**
     * @param string|null $id
     * @return $this
     */
    public function setContactId(string $id = null)
    {
        $this->contactId = $id;
        return $this;
    }

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
     * @throws \Exception
     */
    public function all(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return CompanyContacts::all(
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
    public function add(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return CompanyContacts::add(
            $this->getId(),
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
     * @throws \Exception
     */
    public function remove(array $criteria = [], array $config = []): ResponseInterface
    {
        $this->populate($criteria);

        return CompanyContacts::remove(
            $this->getId(),
            $this->getContactId(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
