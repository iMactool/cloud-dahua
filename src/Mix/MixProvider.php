<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Mix;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

    class MixProvider implements Provider
	{

        public function serviceProvider (Container $container)
        {
            $container['Mix'] = function ($container) {
                return new Mix($container);
            };
        }

    }