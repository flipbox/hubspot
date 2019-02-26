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
trait TypeIdAttributeTrait
{
    /**
     * The type Id
     *
     * @var string
     */
    protected $typeId;

    /**
     * @return string
     * @throws \Exception
     */
    public function getTypeId(): string
    {
        if (null === ($id = $this->findTypeId())) {
            throw new \Exception("Invalid Type Id");
        }
        return $id;
    }

    /**
     * @return string|null
     */
    public function findTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param string|null $id
     * @return $this
     */
    public function setTypeId(string $id = null)
    {
        $this->typeId = $id;
        return $this;
    }
}
