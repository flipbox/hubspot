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
class TimelineEventMutator extends AbstractCriteria
{
    use TypeIdAttributeTrait,
        IdAttributeTrait,
        IntegrationConnectionTrait,
        CacheTrait;

    /**
     * @var string|array
     */
    public $object;

    /**
     * @var array
     */
    public $extraData = [];

    /**
     * @var array|null
     */
    public $payload;

    /**
     * @var array
     */
    public $properties = [];

    /**
     * @var array
     */
    public $timelineIFrame = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        $id = $this->findId();
        return (string)($id ?: substr(str_shuffle(md5(time())), 0, 36));
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        // Explicitly set ?
        if ($this->payload !== null) {
            return (array)$this->payload;
        }

        $payload = array_merge(
            $this->getObjectPayload(),
            [
                'timelineIFrame' => $this->timelineIFrame,
                'extraData' => $this->extraData
            ],
            $this->properties
        );

        return array_filter($payload);
    }

    /**
     * @return array
     */
    protected function getObjectPayload(): array
    {
        if (is_numeric($this->object)) {
            $this->object = ['objectId' => $this->object];
        }

        return (array)$this->object;
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
