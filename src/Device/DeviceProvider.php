<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Device;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

    class DeviceProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['Device'] = function ($container) {
                return new Device($container);
            };
        }
    }