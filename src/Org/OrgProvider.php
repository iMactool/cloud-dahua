<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Org;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

	class OrgProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['Org'] = function ($container) {
                return new Org($container);
            };
        }
    }