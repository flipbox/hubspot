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
class ContactListContactsCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait,
        IdAttributeTrait;

    /**
     * @var array|null
     */
    protected $vids;
    /**
     * @var array|null
     */
    protected $emails;

    /**
     * @return array
     * @throws \Exception
     */
    public function getVids(): array
    {
        if (null === ($ids = $this->findVids())) {
            throw new \Exception("Invalid Contact Ids");
        }
        return (array)$ids;
    }

    /**
     * @return array|null
     */
    public function findVids()
    {
        return $this->vids;
    }

    /**
     * @param array|null $ids
     * @return $this
     */
    public function setVids(array $ids = null)
    {
        $this->vids = $ids;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getEmails(): array
    {
        if (null === ($emails = $this->findEmails())) {
            throw new \Exception("Invalid Contact Emails");
        }
        return (array)$emails;
    }

    /**
     * @return array|null
     */
    public function findEmails()
    {
        return $this->emails;
    }

    /**
     * @param array|null $emails
     * @return $this
     */
    public function setEmails(array $emails = null)
    {
        $this->emails = $emails;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getPayload(): array
    {
        return array_filter(
            [
                'vids' => array_filter($this->getVids()),
                'emails' => array_filter($this->getEmails())
            ]
        );
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

        return ContactListContacts::all(
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

        return ContactListContacts::add(
            $this->getId(),
            $this->getPayload(),
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

        return ContactListContacts::remove(
            $this->getId(),
            $this->getPayload(),
            $this->getConnection(),
            $this->getCache(),
            $this->getLogger(),
            $config
        );
    }
}
