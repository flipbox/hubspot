<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/hubspot/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/hubspot
 */

namespace Flipbox\HubSpot\Criteria;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 2.5.0
 */
trait ParamsAttributeTrait
{
    /**
     * @var array|null
     */
    protected $params;

    /**
     * @return array
     */
    public function getParams(): array
    {
        return array_filter((array)$this->params);
    }

    /**
     * @param $params
     * @return $this
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }
}
