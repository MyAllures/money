<?php
namespace app\admin\controller;
use think\Db;
/**
 * 等级管理控制器
 */
class Make extends AdminBase {

    /**
     * 获取负债记录列表
     *
     */
    public function moneyList() {


        return $this->fetch('money_list');
    }


}
