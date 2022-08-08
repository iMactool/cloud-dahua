<?php
/**
 * ======================================================
 * Author: cc
 * Created by PhpStorm.
 * Copyright (c)  cc Inc. All rights reserved.
 * Desc: 大华云睿开放平台入口
 *  ======================================================.
 */

namespace Imactool\DahuaCloud;


use Imactool\DahuaCloud\Account\AccountProvider;
use Imactool\DahuaCloud\Asc\AscProvider;
use Imactool\DahuaCloud\Auth\AuthProvider;
use Imactool\DahuaCloud\Building\BuildingProvider;
use Imactool\DahuaCloud\Core\ContainerBase;
use Imactool\DahuaCloud\Device\DeviceProvider;
use Imactool\DahuaCloud\Live\LiveProvider;
use Imactool\DahuaCloud\Mix\MixProvider;
use Imactool\DahuaCloud\Mixed\MixedProvider;
use Imactool\DahuaCloud\Msg\MsgProvider;
use Imactool\DahuaCloud\Org\OrgProvider;
use Imactool\DahuaCloud\Person\PersonProvider;
use Imactool\DahuaCloud\Support\Config;
use Imactool\DahuaCloud\Visitor\VisitorProvider;

class Cloud extends ContainerBase
{
    protected $config;

    /**
     * 配置服务提供者.
     *
     * @var string[]
     */
    protected $provider = [
        AuthProvider::class,
        DeviceProvider::class,
        OrgProvider::class,
        AccountProvider::class,
        BuildingProvider::class,
        MixProvider::class,
        AscProvider::class,
        PersonProvider::class,
        VisitorProvider::class,
        MsgProvider::class,
        LiveProvider::class,
        MixedProvider::class,
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
