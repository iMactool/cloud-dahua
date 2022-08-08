<?php
/**
 * ======================================================
 * Author: cc
 * Created by PhpStorm.
 * Copyright (c)  cc Inc. All rights reserved.
 * Desc: 代码功能描述
 *  ======================================================.
 */

namespace Imactool\DahuaCloud\Traits;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

trait CacheAdapter
{
    private static $instance;
    //TODO 支持 Redis
    protected $cachePrefix = 'imactool.cloud.dahua.access_token';

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new FilesystemAdapter();
        }

        return self::$instance;
    }

    protected function getCacheKey($credentials)
    {
        return $this->cachePrefix.md5(json_encode($credentials));
    }
}
