<?php

namespace app\api\controller;

use app\api\controller\Base;
use think\Cache;

/**
 * 签到控制器
 */
class SignUser extends Base {


    /**
     * 签到
     */
    public function sign() {
//        $post = $this->request->post();
        $user_id = $this->getUserId();
        $this->logicSignUser->sign($user_id);
    }
    
    /**
     * 获取签到信息
     */
    public function getInfo() {
        $user_id = $this->getUserId();
        $this->logicSignUser->getInfo($user_id);
    }
    
    /**
     * 获取签到记录
     * @param type $param
     */
    public function getLog() {
        $post = $this->request->post();
        $user_id = $this->getUserId();
        $p = isset($post['p']) ? intval($post['p']) : 1;
        $pagesize = isset($post['pagesize']) ? intval($post['pagesize']) : 10;
        if ($p < 1) {
            $p = 1;
        }
        if ($pagesize < 1) {
            $pagesize = 10;
        }
        $this->logicSignUser->getLog($user_id,$p,$pagesize);
    }
}
