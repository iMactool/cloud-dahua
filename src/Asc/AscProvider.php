<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc:  门禁子系统 Access control subsystem
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Asc;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

    class AscProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['Asc'] = function ($container) {
                return new Asc($container);
            };
        }
    }