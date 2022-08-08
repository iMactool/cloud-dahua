<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Visitor;

	use Imactool\DahuaCloud\Core\Container;
    use Imactool\DahuaCloud\Interfaces\Provider;

    class VisitorProvider implements Provider
	{
        public function serviceProvider (Container $container)
        {
            $container['Visitor'] = function ($container) {
                return new Visitor($container);
            };
        }
    }