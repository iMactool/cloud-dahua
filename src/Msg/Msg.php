<?php
	/**
	 * ======================================================
	 * Author: cc
	 * Created by PhpStorm.
	 * Copyright (c)  cc Inc. All rights reserved.
	 * Desc: 代码功能描述
	 *  ======================================================
	 */

	namespace Imactool\DahuaCloud\Msg;

	use Imactool\DahuaCloud\Core\BaseService;

    class Msg extends BaseService
	{
        /**
         *  通过消息Id查询消息详情
         * 接口使用前提，必须要在平台-消息业务-报警预案功能里配置预案，不然会查询不到消息详情
         * @param $messageId
         *
         * @return mixed
         * @author cc
         */
        public function getMessageInfoById($messageId)
        {
            $params = ['messageId'=>$messageId];
            return $this->postJosn('/gateway/messagecenter/api/messageInfo',$params);
        }
	}