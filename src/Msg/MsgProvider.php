<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Msg;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

    class MsgProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['Msg'] = function ($container) {
                return new Msg($container);
            };
        }
    }