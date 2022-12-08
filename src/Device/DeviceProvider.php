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

    /**
     * Class DeviceProvider
     *
     * @method getDeviceList(array $params)
     * @method subEvent(array $params)
     * @method getDeviceInfo(array $params)
     * @method updateDevice(array $params)
     * @method addDevice(array $params)
     * @method deleteDevice(string $deviceId)
     * @method getChannelSnap(array $params)
     * @method devicePTZInfo(array $params)
     * @method controlMovePTZ(array $params)
     * @method controlLocationPTZ(array $params)
     *
     * @package Imactool\DahuaCloud\Device
     * @version 1.0.0
     */
    class DeviceProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['Device'] = function ($container) {
                return new Device($container);
            };
        }
    }