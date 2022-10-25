<?php
/**
 * ======================================================
 * Author: cc
 * Created by PhpStorm.
 * Copyright (c)  cc Inc. All rights reserved.
 * Desc: 代码功能描述
 *  ======================================================.
 */

namespace Imactool\DahuaCloud\Auth;

use GuzzleHttp\Exception\BadResponseException;
use Imactool\DahuaCloud\Core\BaseService;
use Imactool\DahuaCloud\Traits\CacheAdapter;

class Auth extends BaseService
{
    use CacheAdapter;

    protected $token;

    /**
     * 大华云睿 获取认证，获取access_token
     * 一般不需要单独调用
     * @return mixed
     * @author cc
     */
    public function getAccessToken()
    {
        $params = [
            'client_id'     => self::$config['client_id'],
            'client_secret' => self::$config['client_secret'],
            'grant_type'    => 'client_credentials',
            'scope'         => 'server'
        ];
        try {
            return  $this->basePost("/gateway/auth/oauth/token",$params);
        }catch (BadResponseException $e){
            return $e->getMessage();
        }
    }

    /**
     * 获取云睿平台配置
     * @return mixed
     *              返回值：
     *               androidCode Android安全码
     *               iosCode iOS安全码
     *               realmName 视频播放初始化所需环境
     * @author cc
     */
    public function getLechangeConfig()
    {
        return $this->getJson('/gateway/membership/api/common/getLechangeConfig');
    }

    /**
     * 乐橙
     * accessToken：获取管理员token
     * 根据管理员账号appId和appSecret获取accessToken，appId和appSecret可以在控制台-我的应用-应用信息中找到。
     * @author cc
     */
    public function getImouAccessToken()
    {
        return $this->postJosn('/openapi/accessToken');
    }
}
