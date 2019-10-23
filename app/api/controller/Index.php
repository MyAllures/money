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
class Index extends Base {

    public function index() {  
        //1.购买课程下单
 $data=$this->request->post('content');
 $url = explode(',', $data);
 dump($url);

    }

}
