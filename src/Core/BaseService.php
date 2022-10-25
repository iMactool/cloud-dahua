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
    protected $cloud_imou_token;
    public    $nowApp;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $class = get_class($this->app);
        $this->nowApp = basename(str_replace('\\','/',$class));
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

        if ($this->nowApp =='Cloud'){
            return "https://www.cloud-dahua.com"; //大华云睿
        }else if($this->nowApp == 'Imou'){
            return "https://openapi.lechange.cn"; //乐橙
        } else{ //大华ICC、H8900平台
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
        if ($this->nowApp =='Cloud'){
            $headers = $this->generateCloudHeader($headers);
        }else if($this->nowApp == 'Imou'){

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
        if ($this->nowApp =='Cloud'){
            $headers = $this->generateCloudHeader($headers);
        }else if($this->nowApp == 'Imou'){
            $sysParams = $this->imouSystemParams();
            $params = array_merge($sysParams,['params'=>\json_encode($params,JSON_FORCE_OBJECT)]);
        }
        return $this->httpClient()->request('post', $endpoint, [
            'headers' => $headers,
            'json'    => $params,
//            'debug'   => true
        ]);
    }

    /**
     * 乐橙api 请求 专用
     * @see https://open.imou.com/book/http/develop.html
     * @param       $endpoint
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     * @author cc
     */
    public function postApiJson($endpoint, $params = [], $headers = [])
    {
        $sysParams = $this->imouSystemParams();
        $params = array_merge($sysParams,['params'=>\json_encode($params,JSON_FORCE_OBJECT)]);
        $data   = $this->requestImouAccessToken();
        $params['token'] = $data['accessToken'];
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
        if ($this->nowApp =='Cloud'){
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
        if ($this->nowApp =='Cloud'){
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
        if ($this->nowApp =='Cloud'){
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
     * 乐橙开放平台HTTP公共请求参数
     * @see https://open.imou.com/book/http/develop.html
     * @return array
     * @author cc
     */
    public function imouSystemParams()
    {
        $time = time();
        $nonce = $this->randString(32);
        return [
            'system' => [
                'ver'   => '1.0',
                'sign'  => $this->imouSign($time,$nonce),
                'appId' => self::$config['appId'],
                'time'  => $time,
                'nonce' => $nonce
            ],
            'id'    => date('Y-m-d-H-i-s').'-'.microtime(true)
        ];
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

    /**
     * 乐橙 accessToken：获取管理员token
     * 根据管理员账号appId和appSecret获取accessToken，appId和appSecret可以在控制台-我的应用-应用信息中找到。
     * @see https://open.imou.com/book/http/accessToken.html
     * @return mixed|void
     * @throws \Psr\Cache\InvalidArgumentException
     * @author cc
     */
    public function requestImouAccessToken()
    {
        $cacheKey = $this->getLcCacheKey(self::$config);
        $accessToken = CacheAdapter::getInstance()->getItem($cacheKey);
        if (!$accessToken->isHit()) {
            echo "没有命中缓存~";
            $result = $this->refreshImouAccessToken();
            $result = \json_decode($result,true);
            var_dump($result);
            if (!empty($result) && (int)$result['result']['code'] === 0) {
                $data = $result['result']['data'];
                $this->cloud_imou_token = $data['accessToken'];
                $accessToken->set($data);
                $accessToken->expiresAfter((int) $data['expireTime'] - 3);
                CacheAdapter::getInstance()->save($accessToken);
                return $data;
            }
            return $result;
        } else {
            echo "命中缓存~!!!";
            return $accessToken->get();
        }
    }

    public function refreshImouAccessToken()
    {
        return $this->postJosn('/openapi/accessToken');
    }

    /**
     * 乐橙 HTTP鉴权摘要算法
     * @see https://open.imou.com/book/http/develop.html
     * @param $time 时间戳
     * @param $nonce  随机字符串
     * @return string
     * @author cc
     */
    public function imouSign($time,$nonce)
    {
        $appSecret = self::$config['appSecret'];
        $singStr = "time:$time,nonce:$nonce,appSecret:$appSecret";
        return md5($singStr);
    }

    /**
     * 生成随机字符串
     *
     * @access public
     * @param integer $length 字符串长度
     * @param string $specialChars 是否有特殊字符
     * @return string
     */
    public  function randString($length, $specialChars = false) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ($specialChars) {
            $chars .= '!@#$%^&*()';
        }
        $result = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[rand(0, $max)];
        }
        return $result;
    }

}
