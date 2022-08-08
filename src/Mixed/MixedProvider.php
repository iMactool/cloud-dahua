<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Mixed;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

    class MixedProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['Mixed'] = function ($container) {
                return new Mixed($container);
            };
        }
    }