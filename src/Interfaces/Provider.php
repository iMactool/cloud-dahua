<?php
/**
 * ======================================================
 * Author: cc
 * Created by PhpStorm.
 * Copyright (c)  cc Inc. All rights reserved.
 * Desc: 代码功能描述
 *  ======================================================.
 */

namespace Imactool\DahuaCloud\Interfaces;

use Imactool\DahuaCloud\Core\Container;

interface Provider
{
    public function serviceProvider(Container $container);
}
