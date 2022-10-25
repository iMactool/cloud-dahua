<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 乐橙云 https://open.imou.com/book/http/develop.html
     *
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud;

    use Imactool\DahuaCloud\Auth\AuthProvider;
    use Imactool\DahuaCloud\Core\ContainerBase;
    use Imactool\DahuaCloud\LcDevice\LcDeviceProvider;
    use Imactool\DahuaCloud\Nb\NbProvider;
    use Imactool\DahuaCloud\Support\Config;

    class Imou extends ContainerBase
	{
        protected $config;

        /**
         * 配置服务提供者.
         *
         * @var string[]
         */
        protected $provider = [
            AuthProvider::class,
            LcDeviceProvider::class,
            NbProvider::class
        ];

        public function __construct(array $config = [])
        {
            $this->config = new Config($config);
            parent::__construct();
            $this->setConfig($config);
        }

        public function getConfig()
        {
            return $this->config;
        }
	}