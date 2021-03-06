<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.0.0
 */
trait IdAttributeTrait
{
    /**
     * @var string|null
     */
    protected $id;

    /**
     * @return string
     * @throws \Exception
     */
    public function getId(): string
    {
        if (null === ($id = $this->findId())) {
            throw new \Exception("Invalid Object Id");
        }
        return $id;
    }

    /**
     * @return string|null
     */
    public function findId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return $this
     */
    public function setId(string $id = null)
    {
        $this->id = $id;
        return $this;
    }
}
