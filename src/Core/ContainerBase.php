<?php
/**
 * ======================================================
 * Author: cc
 * Created by PhpStorm.
 * Copyright (c)  cc Inc. All rights reserved.
 * Desc: 代码功能描述
 *  ======================================================.
 */

namespace Imactool\DahuaCloud\Core;

class ContainerBase extends Container
{
    protected $config;

    /**
     * @var array
     */
    protected $provider = [];

    public function __construct()
    {
        $providerCallback = function ($provider) {
            $obj = new $provider();
            $this->serviceRegsiter($obj);
        };
        array_walk($this->provider, $providerCallback);
    }

    public function __get($key)
    {
        return $this->offsetGet($key);
    }

    public function setConfig($config = [])
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
