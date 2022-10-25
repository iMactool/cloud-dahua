<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\LcDevice;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

    class LcDeviceProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['LcDevice'] = function ($container) {
                return new LcDevice($container);
            };
        }
    }