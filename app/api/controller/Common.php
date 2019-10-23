<?php

// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

namespace app\api\controller;

use app\api\controller\Base;
use think\Cache;

/**
 * 演示控制器
 */
class Common extends Base {

    /**
     * 获取最新公告
     */
    public function getlastNotice() {
         $this->logicCommon->getlastNotice();
    }

    public function getNotice() {
        $post = $this->request->post();
        $p = isset($post['p']) ? intval($post['p']) : 1;
        if ($p < 1) {
            $p = 1;
        }
        $pagesize = isset($post['pagesize']) ? intval($post['pagesize']) : 1;
        if ($pagesize < 1) {
            $pagesize = 10;
        }
        $this->logicCommon->getNotice($p, $pagesize);
    }

    public function article_detail() {
        $post = $this->request->post();
        $id = $post['id'];
        $this->logicCommon->article_detail($id);
    }

    public function bank_list() {
        $post = $this->request->post();
        $name = $post['name'];
        $this->logicCommon->bank_list($name);
    }

    public function lesson() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $p = isset($post['p']) ? intval($post['p']) : 1;
        if ($p < 1) {
            $p = 1;
        }
        $pagesize = isset($post['pagesize']) ? intval($post['pagesize']) : 1;
        if ($pagesize < 1) {
            $pagesize = 10;
        }
        $this->logicCommon->lesson($p, $pagesize);
    }

}
