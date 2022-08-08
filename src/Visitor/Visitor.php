<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 云睿 访客子系统
     *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Visitor;

	use Imactool\DahuaCloud\Core\BaseService;

    class Visitor extends BaseService
	{
        /**
         * 取消邀请
         * @param $visitorId
         *
         * @return mixed
         * @author cc
         */
        public function visitorCancel($visitorId)
        {
            $params = ['visitorId' => $visitorId];
            return $this->deleteJson('',$params,['Content-Typ'=>'application/x-www-form-urlencoded']);
        }

        /**
         *   查询访客邀请记录
         * @param $visitorId
         *
         * @return mixed
         * @author cc
         */
        public function queryVisitorInviteRecord($visitorId)
        {
            $params = ['visitorId'=>$visitorId];
            return $this->getJson('/gateway/dsc-owner/api/queryVisitorInviteRecord/'.$visitorId,$params);
        }

        /**
         *  邀请访客
         * @param array $params
         *
         * @return mixed
         * @author cc
         */
        public function visitorAppoint(array $params)
        {
            return $this->postJosn('/gateway/dsc-owner/api/visitorAppoint',$params);
        }
	}