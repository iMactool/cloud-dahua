<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Account;

    use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

	class AccountProvider implements Provider
	{
        public function serviceProvider(Container $container)
        {
            $container['Account'] = function ($container) {
                return new Account($container);
            };
        }
	}