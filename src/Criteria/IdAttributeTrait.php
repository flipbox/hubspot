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
     * @var string
     */
    public $id = '';

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
}
