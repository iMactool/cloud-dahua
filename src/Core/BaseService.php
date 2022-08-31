<?php
/**
 * ======================================================
 * Author: cc
 * Created by PhpStorm.
 * Copyright (c)  cc Inc. All rights reserved.
 * Desc: 代码功能描述
 *  ======================================================.
 */

namespace Imactool\DahuaCloud\Core;

use GuzzleHttp\Exception\BadResponseException;
use Imactool\DahuaCloud\Http\Http;
use Imactool\DahuaCloud\Traits\CacheAdapter;

class BaseService
{
    use CacheAdapter;

    protected $app;
    public static $client;
    protected static $config;
    protected $clodEntry = true; //大华云睿应用入口
    protected $cloud_access_token;

    public function __construct(Container $app)
    {
        $this->app = $app;
//        $InterfacEntry = get_class($app);
//        if ($InterfacEntry == "Imactool\\DahuaCloud\\Cloud"){
//            $this->clodEntry = true;
//        }
        $this->setConfig($app->getConfig());
    }

    public function setConfig($config)
    {
        if (is_null(self::$config)) {
            self::$config = $config;
        } else {
            self::$config = array_merge(self::$config, $config);
        }
    }

    /**
     * 以字符串 获取URL 参数.
     *
     * @return string
     *
     * @author cc
     */
    protected function queryString()
    {
        return 'userId='.self::$config['userId'].'&userName='.self::$config['loginName'].'&token='.self::$config['token'];
    }

    /**
     * 以数组形式 获取URL 参数.
     *
     * @return array
     *
     * @author cc
     */
    protected function queryArr(array $params = [])
    {
        $arr = [
            'userId'   => self::$config['userId'],
            'userName' => self::$config['loginName'],
            'token'    => self::$config['token'],
        ];

        return array_merge($arr, $params);
    }

    public function headerJson()
    {
        return ['Content-type'=>'application/json'];
    }

    /**
     * 大华云睿（零售云） api 公共请求 header
     * @return string[]
     * @author cc
     */
    public function cloudApiHeader()
    {
        $result = $this->getCloudAccessToken();
        $access_token = '';
        if (is_array($result)){
            $access_token = $result['access_token'];
        }
        return [
            'Authorization'     => 'Bearer '.$access_token,
            'Content-type'      => 'application/json;charset=utf-8',
            'Accept-Language'   => 'zh-CN'
        ];
    }

    protected function getUrl()
    {
        if ($this->clodEntry){
            return "https://www.cloud-dahua.com";
        }else{
            return  self::$config['scheme'].'://'.self::$config['ip'].':'.self::$config['port'];
        }

    }

    public function httpClient()
    {
        if (!self::$client) {
            self::$client = new Http();
            self::$client->setUrl($this->getUrl());
        }

        return self::$client;
    }

    /**
     * 发送 get 请求
     *
     * @param string $endpoint
     * @param array  $query
     * @param array  $headers
     *
     * @return mixed
     */
    public function get($endpoint, $query = [], $headers = [])
    {
        if ($this->clodEntry){
            $headers = $this->generateCloudHeader($headers);
        }
        return $this->httpClient()->request('get', $endpoint, [
            'headers' => $headers,
            'query'   => $query,
//            'debug'   => true
        ]);
    }

    /**
     * 发送 post 请求
     *
     * @param string $endpoint
     * @param array  $params
     * @param array  $headers
     *
     * @return mixed
     */
    public function post($endpoint, $params = [], $headers = [])
    {
        return $this->httpClient()->request('post', $endpoint, [
            'header'      => $headers,
            'form_params' => $params,
        ]);
    }

    public function basePost($endpoint, $params = [], $headers = [])
    {
        return $this->httpClient()->request('post', $endpoint, [
            'header'      => $headers,
            'form_params' => $params,
        ]);
    }

    /**
     * 用 json 的方式发送 post 请求
     *
     * @param $endpoint
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     */
    public function postJosn($endpoint, $params = [], $headers = [])
    {
        if ($this->clodEntry){
            $headers = $this->generateCloudHeader($headers);
        }
        return $this->httpClient()->request('post', $endpoint, [
            'headers' => $headers,
            'json'    => $params,
//            'debug'   => true
        ]);
    }

    /**
     *用 json 的方式发送 get 请求
     * @param       $endpoint
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     * @author cc
     */
    public function getJson($endpoint, $params = [], $headers = [])
    {
        if ($this->clodEntry){
            $headers = $this->generateCloudHeader($headers);
        }
        return $this->httpClient()->request('get', $endpoint, [
            'headers' => $headers,
            'json'    => $params,
            'query'   => $params,
//            'debug'   => true
        ]);
    }

    public function deleteJson($endpoint, $params = [], $headers = [])
    {
        if ($this->clodEntry){
            $headers = $this->generateCloudHeader($headers);
        }
        $options = [
            'form_params'=> $params,
            'headers'    => $headers
        ];
        return $this->httpClient()->request('DELETE',$endpoint,$options);
    }

    public function putJson($endpoint, $params = [], $headers = [])
    {
        if ($this->clodEntry){
            $headers = $this->generateCloudHeader($headers);
        }
        $options = [
            'body'      => json_encode($params),
            'headers'    => $headers
        ];
        return $this->httpClient()->request('PUT',$endpoint,$options);
    }

    /**
     * 组装云睿公共请求API header 参数
     * @param array $headers
     *
     * @return array|string[]
     * @author cc
     */
    public function generateCloudHeader($headers = [])
    {
        if (!empty($headers)){
           return array_merge($this->cloudApiHeader(),$headers);
        }else{
            return $this->cloudApiHeader();
        }
    }


    /**
     *
     * 获取授权信息
     *
     * @return  [
     *      'access_token' => '96290747-e9f6-4348-919e-737d0777389a',
     *       'expires_in' => 604799,
     *       'token_type' => 'bearer',
     *       'scope' => 'server',
     *       'username' => 're7a4d5b893b27448f9bef7537db104041'
     *  ]
     *
     * @throws \Psr\Cache\InvalidArgumentException
     * @author cc
     */
    public function getCloudAccessToken()
    {
        $cacheKey = $this->getCacheKey(self::$config);
        $accessToken = CacheAdapter::getInstance()->getItem($cacheKey);
        if (!$accessToken->isHit()) {
            $result = $this->refreshCloudAccessToken();
            if (!empty($result)) {
                $this->cloud_access_token = $result['access_token'];
                $accessToken->set($result);
                $accessToken->expiresAfter((int) $result['expires_in'] - 3);
                CacheAdapter::getInstance()->save($accessToken);
                return $result;
            }
        } else {
            return $accessToken->get();
        }
    }

    public function refreshCloudAccessToken()
    {
        $params = [
            'client_id'     => self::$config['client_id'],
            'client_secret' => self::$config['client_secret'],
            'grant_type'    => 'client_credentials',
            'scope'         => 'server'
        ];
        return  $this->basePost("/gateway/auth/oauth/token",$params);
    }

}
