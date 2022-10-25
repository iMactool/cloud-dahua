<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\LcDevice;

	use Imactool\DahuaCloud\Core\BaseService;

    class LcDevice extends BaseService
	{

        /**
         * 未绑定设备信息获取
         *
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function unBindDeviceInfo(array $params)
        {
            return $this->postApiJson('/openapi/unBindDeviceInfo',$params);
        }

        /**
         * bindDevice：绑定设备
         * 将设备绑定在指定账号下。
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function bindDevice(array $params)
        {
            return $this->postApiJson('/openapi/bindDevice',$params);
        }

        /**
         * unBindDevice：解绑设备
         * 将账号下指定设备解绑。
         * @param string $deviceId
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function unBindDevice(string $deviceId)
        {
            $params['deviceId'] = $deviceId;
            return $this->postApiJson('/openapi/unBindDevice',$params);
        }

        /**
         * 获取设备添加流程
         * 设备市场型号，可以通过 unBindDeviceInfo 接口获取或者在产品包装盒上获取
         * @param string $deviceModelName
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function deviceAddingProcessGuideInfoGet(string $deviceModelName)
        {
            $params['deviceModelName'] = $deviceModelName;
            return $this->postApiJson('/openapi/deviceAddingProcessGuideInfoGet',$params);
        }

        /**
         * 校验设备添加流程是否已更新
         * 检测乐橙云配置好的各类设备添加流程信息是否已更新，客户端检测到更新后可以重新加载设备添加流程配置信息。
         * @param string $updateTime
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function deviceAddingProcessGuideInfoCheck(string $updateTime)
        {
            $params['updateTime'] = $updateTime;
            return $this->postApiJson('/openapi/deviceAddingProcessGuideInfoCheck',$params);
        }

        /**
         * 批量查询设备详细信息
         * 批量根据设备序列号，获取设备的详细信息。
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function listDeviceDetailsByIds(array $params)
        {
            return $this->postApiJson('/openapi/listDeviceDetailsByIds',$params);
        }

        /**
         * 分页查询设备详细信息
         * t分页获取账号下设备通道的基本信息。
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function listDeviceDetailsByPage(array $params)
        {
            return $this->postApiJson('/openapi/listDeviceDetailsByPage',$params);
        }

        /**
         * 获取设备在线状态
         * 注意：此接口无法获取已被别人绑定的设备在线状态。对于未绑定的设备，返回结果仅表示设备（非给定的0通道）在线状态。
         * @param string $deviceId
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function deviceOnline(string $deviceId)
        {
            $params['deviceId'] = $deviceId;
            return $this->postApiJson('/openapi/deviceOnline',$params);
        }

        /**
         * 查询设备绑定情况
         * 查询设备绑定情况，是否被绑定，是否被当前账户绑定。
         * @param string $deviceId
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function checkDeviceBindOrNot(string $deviceId)
        {
            $params['deviceId'] = $deviceId;
            return $this->postApiJson('/openapi/checkDeviceBindOrNot',$params);
        }

        /**
         * 获取设备升级状态和进度
         * @param string $deviceId
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function upgradeProcessDevice(string $deviceId)
        {
            $params['deviceId'] = $deviceId;
            return $this->postApiJson('/openapi/upgradeProcessDevice',$params);
        }

        /**
         * 修改设备或通道名称
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function modifyDeviceName(array $params)
        {
            return $this->postApiJson('/openapi/modifyDeviceName',$params);
        }

        /**
         * 设备/通道封面刷新
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function refreshDeviceCover(array $params)
        {
            return $this->postApiJson('/openapi/refreshDeviceCover',$params);
        }

        /**
         * 验证设备密码
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function verifyPassword(array $params)
        {
            return $this->postApiJson('/openapi/verifyPassword',$params);
        }

        /**
         * 修改设备密码
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function modifyPassword(array $params)
        {
            return $this->postApiJson('/openapi/modifyPassword',$params);
        }

        /**
         * 获取设备程序最新版本，并升级。
         * @param string $deviceId
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function upgradeDevice(string $deviceId)
        {
            $params['deviceId'] = $deviceId;
            return $this->postApiJson('/openapi/upgradeDevice',$params);
        }

        /**
         * 预案设置
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function setPreparation(array $params)
        {
            return $this->postApiJson('/openapi/setPreparation',$params);
        }

        /**
         * 获取预案
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getPreparation(array $params)
        {
            return $this->postApiJson('/openapi/getPreparation',$params);
        }

        /**
         * 设置热度分析通道级使能开关
         * 备注：需要设备拥有HeatMap热度分析能力。
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function setHeatMapEnable(array $params)
        {
            return $this->postApiJson('/openapi/setHeatMapEnable',$params);
        }

        /**
         * 获取热度分析通道级使能开关
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getHeatMapEnable(array $params)
        {
            return $this->postApiJson('/openapi/getHeatMapEnable',$params);
        }

        /**
         * 热度图数据获取
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getHeatMapData(array $params)
        {
            return $this->postApiJson('/openapi/getHeatMapData',$params);
        }

        /**
         * 删除报警消息
         * 删除指定设备通道指定消息Id对应的设备报警消息。
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function deleteAlarmMessage(array $params)
        {
            return $this->postApiJson('/openapi/deleteAlarmMessage',$params);
        }

        /**
         * 查询用户报警信息
         * 获取设备通道在指定时间段内的设备消息列表。
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getAlarmMessage(array $params)
        {
            return $this->postApiJson('/openapi/getAlarmMessage',$params);
        }

        /**
         * 根据id查询详细的报警消息
         * 根据报警消息Id查询报警详情。
         * @param array $params
         *
         * @return mixed
         * @throws \Psr\Cache\InvalidArgumentException
         * @author cc
         */
        public function getAlarmMessageById(array $params)
        {
            return $this->postApiJson('/openapi/getAlarmMessageById',$params);
        }

	}