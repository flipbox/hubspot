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
class ContactListContactsMutatorCriteria extends AbstractCriteria
{
    use ConnectionTrait,
        CacheTrait;

    /**
     * @var string
     */
    public $id;

    /**
     * @var array
     */
    public $vids = [];

    /**
     * @var array
     */
    public $emails = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return (string)$this->id;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return array_filter(
            [
                'vids' => array_filter($this->vids),
                'emails' => array_filter($this->emails)
            ]
        );
    }

    /**
     * @param array $criteria
     * @param array $config
     * @return ResponseInterface
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
