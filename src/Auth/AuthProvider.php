<?php
/**
 * ======================================================
 * Author: cc
 * Created by PhpStorm.
 * Copyright (c)  cc Inc. All rights reserved.
 * Desc: 代码功能描述
 *  ======================================================.
 */

namespace Imactool\DahuaCloud\Auth;

use Imactool\DahuaCloud\Core\Container;
use Imactool\DahuaCloud\Interfaces\Provider;

class AuthProvider implements Provider
{
    public function serviceProvider(Container $container)
    {
        $container['Auth'] = function ($container) {
            return new Auth($container);
        };
    }
}
