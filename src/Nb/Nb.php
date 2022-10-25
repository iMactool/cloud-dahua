<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Nb;

	use Imactool\DahuaCloud\Core\BaseService;

    class Nb extends BaseService
	{
        /**
         * 绑定NB锁
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function bindNBLock(array $params)
        {
            $this->postApiJson('/openapi/bindNBLock',$params);
        }

        /**
         * 解绑NB锁
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function unBindNBLock(array $params)
        {
            $this->postApiJson('/openapi/unBindNBLock',$params);
        }

        /**
         * 设置数字秘钥
         * @param array $params
         *                     params		是	[object]
                                params>>deviceId	    设备号	是	[string]
                                params>>imei	        设备imei	是	[string]
                                params>>permanentKey	长效密码MD5值	是	[string]
                                params>>startTime	    生效时间，UTC时间	是	[string]
                                params>>endTime	        失效时间，UTC时间	是	[string]
                                params>>useNums	        密钥使用次数，0：秘钥使用不限次数，非0：秘钥可使用次数	是	[string]
                                params>>operatorType	运营商类型，0：电信AEP，1：移动，2：联通，3：电信NB	是	[string]
                                params>>token		    是	[string]
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function setNBPermanentKey(array $params)
        {
            $this->postApiJson('/openapi/setNBPermanentKey',$params);
        }

        /**
         * 获取离线数字秘钥
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getNBOfflinePwd()
        {
            $this->postApiJson('/openapi/getNBOfflinePwd');
        }

        /**
         * 设置卡秘钥
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function setNBCard(array $params)
        {
            $this->postApiJson('/openapi/setNBCard',$params);
        }

        /**
         * 发起设置指纹请求
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function startNBFingerprint(array $params)
        {
            $this->postApiJson('/openapi/startNBFingerprint',$params);
        }

        /**
         * 设置指纹秘钥
         * @param array $params
         *                     params	            [object]    是
                                params>>deviceId	[string]	是	设备号
                                params>>imei	    [string]	是	设备imei
                                params>>data	    [string]	是	指纹数据
                                params>>length	    [int]	    是	单次传输数据长度
                                params>>uid	        [int]	    是	发起设置指纹申请后设备返回的uid
                                params>>operatorType	[int]	是	运营商类型，0：电信AEP，1：移动，2：联通，3：电信NB
                                params>>token	[string]	    是
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function setNBFingerprint(array $params)
        {
            $this->postApiJson('/openapi/setNBFingerprint',$params);
        }

        /**
         * 根据类型删除密钥
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function deleteNBKeyByType(array $params)
        {
            $this->postApiJson('/openapi/deleteNBKeyByType',$params);
        }

        /**
         * 修改秘钥有效期
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function modifyNBKeyEffectiveTime(array $params)
        {
            $this->postApiJson('/openapi/modifyNBKeyEffectiveTime',$params);
        }

        /**
         * 根据ID删除秘钥
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function deleteNBKeyById(array $params)
        {
            $this->postApiJson('/openapi/deleteNBKeyById',$params);
        }

        /**
         * 批量查询NB锁设备信息
         * @param array $params
         *                     params	[object]	是
                               params>>token	    [string]	是	开发者在账号对接模块获取的Token		At_00006acr3456d12312d3grf60147de7ec
                               params>>deviceIds	[string]	是	批量设备序列号，逗号分隔（001,002,003）		MEGREZ0000001842
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function queryNBLockDeviceList(array $params)
        {
            $this->postApiJson('/openapi/queryNBLockDeviceList',$params);
        }

        /**
         * 获取设备锁电量信息
         * 获取门锁设备电量信息。
         * @param string $deviceId
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getDevicePowerInfo(string $deviceId)
        {
            $params['deviceId']  = $deviceId;
            $this->postApiJson('/openapi/getDevicePowerInfo',$params);
        }

        /**
         * 远程开门。
         * @param string $deviceId
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function openDoorRemote(string $deviceId)
        {
            $params['deviceId']  = $deviceId;
            $this->postApiJson('/openapi/openDoorRemote',$params);
        }

        /**
         * 获取秘钥列表
         * 获取门锁设备当前秘钥列表信息。
         * @param string $deviceId
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getDoorKeys(string $deviceId)
        {
            $params['deviceId']  = $deviceId;
            $this->postApiJson('/openapi/getDoorKeys',$params);
        }

        /**
         * 获取开门记录
         * 获取门锁设备开门记录。
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getOpenDoorRecord(array $params)
        {
            $this->postApiJson('/openapi/getOpenDoorRecord',$params);
        }

        /**
         * 生成门锁密码
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function generateSnapkey(array $params)
        {
            $this->postApiJson('/openapi/generateSnapkey',$params);
        }

        /**
         * 废弃密钥
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function deleteDoorKey(array $params)
        {
            $this->postApiJson('/openapi/deleteDoorKey',$params);
        }

        public function getSnapkeyList(string $deviceId)
        {
            $params['deviceId']  = $deviceId;
            $this->postApiJson('/openapi/getSnapkeyList',$params);
        }

        /**
         * 唤醒休眠的门锁设备
         * @param array $params
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function wakeUpDevice(array $params)
        {
            $this->postApiJson('/openapi/wakeUpDevice',$params);
        }

        /**
         * 接听门口机/门铃呼叫
         * 门口机或者门铃类设备在呼叫状态下，接听门口机/门铃的呼叫。
         * @param string $deviceId
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function doorbellCallAnswer(string $deviceId)
        {
            $params['deviceId']  = $deviceId;
            $this->postApiJson('/openapi/doorbellCallAnswer',$params);
        }

        /**
         * 挂断门口机/门铃的呼叫
         * 门口机或者门铃类设备在接听状态下，挂断门口机/门铃的呼叫。
         * @param string $deviceId
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function doorbellCallHangUp(string $deviceId)
        {
            $params['deviceId']  = $deviceId;
            $this->postApiJson('/openapi/doorbellCallHangUp',$params);
        }

        /**
         * 拒接门口机/门铃的呼叫
         * 门口机或者门铃类设备在呼叫状态下，拒接门口机/门铃的呼叫。
         * @param string $deviceId
         *
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function doorbellCallRefuse(string $deviceId)
        {
            $params['deviceId']  = $deviceId;
            $this->postApiJson('/openapi/doorbellCallRefuse',$params);
        }
	}