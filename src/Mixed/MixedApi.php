<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Mixed;

	use GuzzleHttp\Exception\BadResponseException;
    use Imactool\DahuaCloud\Core\BaseService;

    class MixedApi extends BaseService
	{
        /**
         *  AI -> 根据任务id获取相关信息
         * @param $taskId
         *
         *  @return mixed
         * @author cc
         */
        public function getAinfoByTaskId($taskId)
        {
            $params = ['taskId' => $taskId];
            return $this->postJosn('/gateway/ai-training/run/getInfoByTaskId',$params);
        }

        /**
         * 微信管理 -> 根据微信授权码code获取openid
         * @param $code
         *
         *  @return mixed
         * @author cc
         */
        public function getWxOpenidByCode($code)
        {
            $params = ['code' => $code];
            return $this->postJosn('/gateway/membership/api/wx/regist/grantWithWechat/'.$code,$params);
        }

        /**
         * 微信管理 -> 获取微信签名
         * @param $code
         *
         *  @return mixed
         * @author cc
         */
        public function getWxSignature($url)
        {
            $params = ['url' => $url];
            return $this->getJson('/gateway/membership/api/wx/wechat/signature',$params);
        }

       /**
         * 流媒体相关 -> 获取乐橙userToken
         * @param $code
         *
         *  @return mixed
         * @author cc
         */
        public function getLeChengUserToken()
        {
            return $this->postJosn('/gateway/device/api/lechangeToken');
        }

       /**
         * 单点登录 -> 免密登陆接口
         * @param $code
         *
         *  @return mixed
         * @author cc
         */
        public function userToken($telephone)
        {
            $params = ['telephone'=>$telephone];
            return $this->postJosn('/gateway/auth/api/userToken',$params);
        }


       /**
         *  AI热度分析 -> 区域客流热度数据
         * @param $code
         *
         *  @return mixed
         * @author cc
         */
        public function aiAreaFlow(array $params)
        {
            return $this->postJosn('/gateway/passengerflow/api/aiAreaFlow',$params);
        }

       /**
         *  AI热度分析 -> AI热度图绘制数据接口
         * @param $code
         *
         *  @return mixed
         * @author cc
         */
        public function aiHeatMap(array $params)
        {
            return $this->postJosn('/gateway/passengerflow/api/aiHeatMap',$params);
        }

        /**
         *  视频追溯 -> 上传视频追溯单据
         * @param array $params
         *
         *  @return mixed
         * @author cc
         */
        public function videoUploadTicket(array $params)
        {
            return $this->postJosn('/gateway/cashier/api/videoTrace/upload',$params);
        }

       /**
         *  物流追溯 -> 上传物流单据
         * @param array $params
         *
         *  @return mixed
         * @author cc
         */
        public function wlOrderUpload(array $params)
        {
            return $this->postJosn('/gateway/cashier/api/wlOrder/upload',$params);
        }

       /**
         * 收银监督子系统 -> 上传小票数据
         * @param array $params
         *
         *  @return mixed
         * @author cc
         */
        public function postTicketUpload(array $params)
        {
            return $this->postJosn('/gateway/cashier/api/pos/uploadData',$params);
        }

      /**
         * 收银监督子系统 -> 删除pos机和通道关联关系
         * @param array $params
         *
         *  @return mixed
         * @author cc
         */
        public function deletePosDevChannelRel(array $params)
        {
            return $this->deleteJson('/gateway/cashier/api/delPosDevChannelRel',$params);
        }

      /**
         * 收银监督子系统 -> 添加pos机和通道绑定关系
         * @param array $params
         *
         *  @return mixed
         * @author cc
         */
        public function addPosDevChannelRel(array $params)
        {
            return $this->postJosn('/gateway/cashier/api/addPosDevChannelRel',$params);
        }

       /**
         * 巡检考评子系统 -> 上传事件考评图片
         * @param string $pictureBase64 图片base64编码
         *
         *  @return mixed
         * @author cc
         */
        public function captureEvaluation(string $pictureBase64)
        {
            $params = ['pictureBase64'=>$pictureBase64];
            return $this->postJosn('/gateway/patrolshop/api/captureEvaluation/upload',$params);
        }

       /**
         * 巡检考评子系统 -> 处理事件考评
         * @param string $messageId
         *
         *  @return mixed
         * @author cc
         */
        public function evaluationMessage(string $messageId)
        {
            return $this->postJosn('/gateway/messagecenter/api/evaluationMessage/evaluationMessage',['messageId'=>$messageId],['messageId'=>$messageId]);
        }

       /**
         * 巡检考评子系统 -> 店铺员工复议
         * @param array $params
         *
         *  @return mixed
         * @author cc
         */
        public function onlineQuestion(array $params)
        {
            return $this->postJosn('/gateway/patrolshop/api/onlineQuestion/reject',$params);
        }

      /**
         * 巡检考评子系统 -> 查询事件考评详情
         * @param string $messageId
         *
         *  @return mixed
         * @author cc
         */
        public function evaluationMessageInfo(string $messageId)
        {
            $params = ['messageId'=>$messageId];
            return $this->postJosn('/gateway/messagecenter/api/evaluationMessage/evaluationMessage/'.$messageId,$params);
        }

        /**
         *  基础功能 -> 文件上传
         *  @return mixed
         * @author cc
         */
        public function getStoreMap()
        {
            return $this->getJson('/gateway/membership/storeMap/policy');
        }



        /**
         * 刷新OSS图片有效期
         * @param string $photoUrl
         *
         *  @return mixed|string
         * @author cc
         */
        public function refreshOssImg(string $photoUrl)
        {
            $params['photoUrl'] = $photoUrl;
            try {
                return  $this->get("/gateway/rivers/oss/newPath",$params);
            }catch (BadResponseException $e){
                return $e->getMessage();
            }
        }

        /**
         * 查询通道是否开通云存储
         * @param $devChnIds
         *
         *  @return mixed
         * @author cc
         */
        public function getStorageStrategy($devChnIds)
        {
            return $this->postJosn('/gateway/cloudstorage/api/getStorageStrategy',['devChnIds'=>$devChnIds]);
        }

        /**
         * 可视对讲 - 纯云app注册sip
         * @param $phone
         *
         *  @return mixed
         * @author cc
         */
        public function registerChunYunSip($phone)
        {
            $params = ['phone'=>$phone];
            return $this->postJosn('/gateway/dsc-vims/api/registerApp/'.$phone,$params);
        }

    }